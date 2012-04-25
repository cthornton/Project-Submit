<?php


/**
 * General configuration options
 */
$cfg = array(
  
  // Database Config Options
  'db_host' => 'localhost',
  'db_name' => 'projectsubmit',
  'db_user' => 'root',
  'db_pass' => '',
  
  // Database socket. Will probably be /var/run/mysqld/mysqld.sock in Linux.
  // Leave blank to use default.
  'db_socket' => '/tmp/mysql.sock',
  
  // Other Site Options
  // Enable / Disable Debug mode
  // Set to TRUE in DEVELOPMENT
  // Set to FALSE in PRODUCTION (live)
  'env_debug' => true,
  
  'db_cnx_str' => '',
);

// Don't edit below this line!

// Make a connection string
$cnxStr = "mysql:host={$cfg['db_host']};dbname={$cfg['db_name']}";
if(!empty($cfg['db_socket'])) $cnxStr .= ';unix_socket=' . $cfg['db_socket'];

$cfg['db_cnx_str'] = $cnxStr;

return $cfg;

?>