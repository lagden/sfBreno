<?php
set_time_limit(0);
class lagdenAcaoTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            new sfCommandOption('dados', null, sfCommandOption::PARAMETER_REQUIRED, 'The data charge'),
        ));

        $this->namespace        = 'lagden';
        $this->name             = 'acao';
        $this->briefDescription = 'Analisa os dados para ser inserido no banco';
        $this->detailedDescription = <<<EOF
The [lagden:image|INFO] task does things.
Call it with:

    [php symfony lagden:image|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $ds=DIRECTORY_SEPARATOR;
        $rootdir=sfConfig::get('sf_root_dir');
        $tmp="{$rootdir}{$ds}tmp{$ds}";

        // Imovel
        $estateTable = Doctrine_Core::getTable('Estate');
        gc_enabled();

        if(isset($options['dados']))
        {
            $dados=unserialize(base64_decode($options['dados']));
            if(is_array($dados))
            {
                $estate = $estateTable->findOneByReferencia($dados['referencia']);
                $update=1;
                if(!$estate)
                {
                    // New
                    $estate = new Estate();
                    $estate->referencia=$dados['referencia'];
                    $update=0;
                }

                foreach($dados as $k=>$dado)
                {
                    switch($k)
                    {
                        case "neighborhood_id":
                        $estate->$k=static::getBairro($dado);
                        break;

                        case "type_id":
                        $estate->$k=static::getTipo($dado);
                        break;

                        case "Disponibilidades":
                        $estate->$k=static::getDisponibilidade($dado,$estate->id);
                        break;

                        case "Images":
                        case "updated_at":
                        case "referencia":
                        // Do nothing!!
                        break;

                        default:
                        $estate->$k=$dado;
                    }
                }

                // Salva ou Atualiza
                try
                {
                    $estate->save();
                }
                catch (Exception $e)
                {
                    file_put_contents("{$tmp}carga.log","[".date('c')."][acao ] Não foi possível gravar: {$e->getMessage()} \n",FILE_APPEND);
                    die;
                }

                // Cria o dir
                if (!is_dir("{$tmp}{$estate->referencia}")) mkdir("{$tmp}{$estate->referencia}", 0777, true);

                // Coloca os paths das imagens no arquivo de referencia
                if(is_file("{$tmp}/{$estate->referencia}/image.yml")) $currimages = sfYaml::load("{$tmp}/{$estate->referencia}/image.yml");
                else $currimages = false;

                if($currimages)
                {
                    $carrega=array();
                    foreach($dados['Images'] as $el)
                    {
                        if(!in_array($el,$currimages))
                        {
                            array_push($currimages,$el);
                            $carrega[]=$el;
                        }
                    }
                }
                else
                {
                    $currimages = $carrega = $dados['Images'];
                }
                file_put_contents("{$tmp}{$estate->referencia}/image.yml",sfYaml::dump($currimages),LOCK_EX);

                // Se tiver imagem para carregar
                if(count($carrega)>0)
                {
                    exec('./symfony lagden:image --update="'.$update.'" --urls="'. base64_encode(serialize($carrega)) .'" --id="'.$estate->id.'" --ref="'.$estate->referencia.'"',$out);
                }
                // Limpa
                $estate->free(true);
                $estate = null;
                $out = null;
            }
            else
            {
                file_put_contents("{$tmp}carga.log","[".date('c')."][acao ] O dado passado não é uma matriz. \n",FILE_APPEND);
                die;
            }
        }
        else
        {
            file_put_contents("{$tmp}carga.log","[".date('c')."][acao ] Não há dados. \n",FILE_APPEND);
            die;
        }

        gc_collect_cycles();
        die;
    }

    static protected function getDisponibilidade($o,$e=false)
    {
        $dCollection = new Doctrine_Collection('Disponibilidade');
        $dTable = Doctrine_Core::getTable('Disponibilidade');
        $deTable = Doctrine_Core::getTable('EstateDisponibilidade');
        $de=false;
        $d = $dTable->findOneByNameOrCreate($o);
        if($d)
        {
            if($e) $de = $deTable->findOneByDisponibilidadeIdAndEstateId($d->id,$e);
            if(!$de) $dCollection->add($d);
        }
        $d=null;
        return $dCollection;
    }

    static protected function getTipo($o)
    {
        $typeTable = Doctrine_Core::getTable('Type');
        $tipo = $typeTable->findOneByNameOrCreate($o);
        $id = $tipo->id;
        $tipo=null;
        return $id;
    }

    static protected function getBairro($o)
    {
        $cityTable = Doctrine_Core::getTable('City');
        $bairroTable = Doctrine_Core::getTable('Neighborhood');
        $city = $cityTable->findOneByNameOrCreate($o['cidade']);
        $bairro = $bairroTable->findOneByNameOrCreate($o['bairro'], $city->id);
        $id = $bairro->id;
        $city = null;
        $bairro = null;
        return $id;
    }
}
