<?php
return array(
  'urlFormat'=>'path',
  'showScriptName' => false,
  'rules'=>array(
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>/<id>'
    
  ),
);