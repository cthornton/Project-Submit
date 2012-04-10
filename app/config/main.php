<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
  'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
  'name' => 'Project Submit',
  'runtimePath' => realpath(dirname(__FILE__)) . '/../../tmp',

  // preloading 'log' component
  'preload'=>array('log'),

  // autoloading model and component classes
  'import'=>array(
    'application.models.*',
    'application.components.*',
    'application.modules.rights.*',
    'application.modules.rights.components.*',
  ),

  'defaultController'=>'welcome',

  // application components
  'components'=>array(
    'request' => array(
      'enableCsrfValidation'=>true,
      'enableCookieValidation'=>true,
    ),
    'user'=>array(
      'class' => 'WebUser',
      'loginUrl' => array('users/login'),
      'allowAutoLogin'=>true,
    ),
    'authManager' => array(
      'class' => 'AuthManager',
    ),
    'db'=> require_once('database.php'),
    'errorHandler'=>array(
      'errorAction'=>'welcome/error',
    ),
    'urlManager'=> require_once('routes.php'),
    'log'=>array(
      'class'=>'CLogRouter',
      'routes'=>array(
        array(
          'class'=>'CFileLogRoute',
          'levels'=>'error, warning',
        ),
      ),
    ),
  ),

  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params' => require(dirname(__FILE__).'/params.php'),
);