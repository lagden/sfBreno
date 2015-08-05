<?php
define('APP_ENV', 'prod');
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', APP_ENV, false);
sfContext::createInstance($configuration)->dispatch();
