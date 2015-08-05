<?php
date_default_timezone_set('America/Sao_Paulo');

ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 1);
ini_set("session.use_trans_sid", 0);

// Dump
ini_set('xdebug.var_display_max_depth', 5);

defined('APP_ENV') || define('APP_ENV', 'prod');

// require_once dirname(__FILE__).'/../lib/projeto/Helper.class.php';
require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/config/sfProjectConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins([
      'sfDoctrinePlugin',
      'csDoctrineActAsSortablePlugin'
    ]);
  }
}
