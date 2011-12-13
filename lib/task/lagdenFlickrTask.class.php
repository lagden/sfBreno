<?php
set_time_limit(0);
class lagdenFlickrTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
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
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $estateTable = Doctrine_Core::getTable('Estate');
        $estates = $estateTable->findAll()->toArray();
        foreach ($estates as $estate)
        {
            gc_enabled();
            exec('./symfony lagden:image --id="'.$estate['id'].'" --ref="'.$estate['referencia'].'"',$out);
            print_r($out); echo "\n";
            echo "Mem usage is: ", memory_get_usage(), "\n";
            $out = null;
            $estate = null;
            gc_collect_cycles();
        }
        gc_disable();
        echo "Finalizado\n";die;
    }
}