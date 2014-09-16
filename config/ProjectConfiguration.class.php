<?php

// Dump
ini_set('xdebug.var_display_max_depth', 4 );

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/config/sfProjectConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array(
        'sfDoctrinePlugin',
        'csDoctrineActAsSortablePlugin'
    ));
  }
}
