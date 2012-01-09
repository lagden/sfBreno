<?php
set_time_limit(0);
class lagdenImageTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            new sfCommandOption('id', null, sfCommandOption::PARAMETER_REQUIRED, 'The id of estate'),
            new sfCommandOption('ref', null, sfCommandOption::PARAMETER_REQUIRED, 'The referencia of estate'),
            new sfCommandOption('urls', null, sfCommandOption::PARAMETER_REQUIRED, 'The urls of images'),
            new sfCommandOption('update', null, sfCommandOption::PARAMETER_REQUIRED, 'The update flag'),
        ));

        $this->namespace        = 'lagden';
        $this->name             = 'image';
        $this->briefDescription = 'Carega as imagens para o resgistro do imóvel';
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

        gc_enabled();
        
        $ds=DIRECTORY_SEPARATOR;
        $rootdir=sfConfig::get('sf_root_dir');
        $tmp="{$rootdir}{$ds}tmp{$ds}";
        $webdir=sfConfig::get('sf_web_dir');
        $ref="tmp{$ds}{$options['ref']}{$ds}";
        $dir="{$webdir}{$ds}{$ref}";
        $return=true;
        
        // Diretorio onde ficara as imagens
        if (!is_dir("{$dir}")) mkdir("{$dir}", 0777, true);
        $currDir=getcwd();
        chdir($dir);
        
        $urls=unserialize(base64_decode($options['urls']));
        if(is_array($urls))
        {
            foreach($urls as $url)
            {
                echo "Baixando: {$url}\n";
                exec("wget -q -nc {$url}");
            }
        }
        
        // Volta para o diretorio atual
        chdir($currDir);

        $itens = glob("{$dir}{*.jpg,*.jpeg,*.png,*.gif}",GLOB_BRACE);
        if($itens)
        {
            $total = count($itens);
            $cc=1;
            foreach($itens as $item)
            {
                if(is_file($item))
                {
                    $file = "..{$ds}{$ref}" . basename($item);
                    try
                    {
                        $image = new Image();
                        $image->file = $file;
                        $image->estate_id = $options['id'];
                        if($options['update']==0)$image->destaque = ($cc==$total) ? 1 : 0;
                        $image->external = 1;
                        $image->save();
                        $image->free(true);
                        $image = null;
                        file_put_contents("{$tmp}carga.log","[".date('c')."][image] Gravado: {$file}. \n",FILE_APPEND);
                    }
                    catch (Exception $e)
                    {
                        file_put_contents("{$tmp}carga.log","[".date('c')."][image] Falha ao gravar: {$file}. \n",FILE_APPEND);
                    }
                    $file=null;
                }
                $cc++;
            }
        }
        $ds=null;
        $total=null;
        $cc=null;
        $webdir=null;
        $ref=null;
        $dir=null;
        $itens=null;
        gc_collect_cycles();
        die;
    }
}
