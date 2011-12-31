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

        // Imovel
        $estateTable = Doctrine_Core::getTable('Estate');
        $refLog=false;
        gc_enabled();

        if(isset($options['dados']))
        {
            $dados=unserialize(base64_decode($options['dados']));
            if(is_array($dados))
            {
                $estate = $estateTable->findOneByReferencia($dados['referencia']);
                if($estate)
                {
                    // Edit
                    $refLog=true;
                }
                else
                {
                    // New
                    $estate = new Estate();
                    $estate->referencia=$dados['referencia'];
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
                        $estate->$k=static::getDisponibilidade($dado);
                        break;

                        case "Images":
                        case "updated_at":
                        // Do nothing!!
                        break;

                        default:
                        $estate->$k=$dado;
                    }
                }

                try
                {
                    $estate->save();
                }
                catch (Exception $e)
                {
                    die("Não foi possível gravar. \n");
                }
                
                // if(!$refLog)
                // {
                //     
                // }
                // var_dump($estate->id,$estate->referencia,$refLog);
                // print_r($dados['Images']);die;
                // $estate->free(true);
                // $estate = null;
            }
            else
            {
                die("O dado passado não é uma matriz. \n");
            }
        }
        else
        {
            die("Não há dados. \n");
        }
        
        gc_collect_cycles();
        die();
    }

    static protected function getDisponibilidade($o)
    {
        $dCollection = new Doctrine_Collection('Disponibilidade');
        $dTable = Doctrine_Core::getTable('Disponibilidade');
        $d = $dTable->findOneByNameOrCreate($o);
        if($d)
        {
            $dCollection->add($d);
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
