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
        ));

        $this->namespace        = 'lagden';
        $this->name             = 'image';
        $this->briefDescription = '';
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
        $webdir=sfConfig::get('sf_web_dir');
        $ref="flickr{$ds}AA{$options['ref']}{$ds}";
        $dir="{$webdir}{$ds}{$ref}";
        $return=true;

        if(is_dir($dir)==false)return false;

        $itens = glob("{$dir}{*.jpg,*.jpeg,*.png,*.gif}",GLOB_BRACE);
        if($itens)
        {
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
                        $image->save();
                        $image->free(true);
                        $image = null;
                        echo "Gravado: {$file}\n";
                    }
                    catch (Exception $e)
                    {
                        echo "Falha ao gravar: {$file}\n";
                    }
                    $file=null;
                }
            }
        }
        else $return=false;

        $ds=null;
        $webdir=null;
        $ref=null;
        $dir=null;
        $itens=null;
        
        gc_collect_cycles();
        die();
    }
}
