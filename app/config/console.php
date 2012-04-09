<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Project Submit Console Application',
  'runtimePath' => realpath(dirname(__FILE__)) . '/../../tmp',
  'preload'=>array('log'),
  'import' => array(
    'application.models.*',
    'application.components.*',
  ),
  'components' => array(
    'db' => require_once('database.php'),
    'urlManager' => require_once('routes.php'),
  )
);