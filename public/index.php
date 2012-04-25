<?php
// Get config options
$cfg = require_once(dirname(__FILE__) . '/../config.php');


// change the following paths if necessary
$yii=dirname(__FILE__) .'/../framework/yii.php';
$config = dirname(__FILE__).'/../app/config/main.php';
require_once(dirname(__FILE__) . '/../helpers.php');

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', $cfg['env_debug']);

unset($cfg);

require_once($yii);
Yii::createWebApplication($config)->run();
