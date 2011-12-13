<?php
set_time_limit(0);
class lagdenFlickrTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name','backend'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace        = 'lagden';
        $this->name             = 'flickr';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [lagden:flickr|INFO] task does things.
Call it with:

    [php symfony lagden:flickr|INFO]
EOF;
    }
    
    protected function execute($arguments = array(), $options = array())
    {
        set_time_limit(0);
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $estateTable = Doctrine_Core::getTable('Estate');
        $estates = $estateTable->findAll();
        foreach ($estates as $estate)
        {
            $r = static::image($estate);
            echo ($r) ? join('',$r) : "{$estate->referencia} not found\n";
        }
        echo "Finalizado\n";die;
    }
    
    static private function image($estate)
    {
        $ds=DIRECTORY_SEPARATOR;
        $webdir=sfConfig::get('sf_web_dir');
        $ref="flickr{$ds}AA{$estate->referencia}{$ds}";
        $dir="{$webdir}{$ds}{$ref}";
        
        if(is_dir($dir)==false)return false;
        
        $response=array();
        $itens = glob("{$dir}{*.jpg,*.jpeg,*.png,*.gif}",GLOB_BRACE);
        if($itens)
        {
            foreach($itens as $item)
            {
                if(is_file($item))
                {
                    try
                    {
                        $file = "..{$ds}{$ref}" . basename($item);
                        echo "Atual: {$file}\n";
                        $image = new Image();
                        $image->file = $file;
                        $image->estate_id = $estate->id;
                        $image->save();
                        $response[]="Gravado: {$item}\n";
                    }
                    catch (Exception $e)
                    {
                        $response[]="Falha ao gravar: {$item}\n";
                    }
                }
            }
        }
        else return false;
        return $response;
    }
}