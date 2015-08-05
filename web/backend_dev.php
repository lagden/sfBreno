<?php
define('APP_ENV', 'dev');
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', APP_ENV, true);
sfContext::createInstance($configuration)->dispatch();
