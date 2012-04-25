<?php
$cfg = require(dirname(__FILE__) . '/../../config.php');

// die(var_dump($cfg));

// Database settings
return array(
  'class' => 'CDbConnection',
  'connectionString' => $cfg['db_cnx_str'],
  'emulatePrepare' => true,
  'username' => $cfg['db_user'],
  'password' => $cfg['db_pass']
);

?>