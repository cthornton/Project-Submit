<?php
// Ensure they passed some arguments
if(count($argv) == 1)
  die(showHelp());

define('PUBLIC_DIR', realpath(dirname(__FILE__) . '/../public/'));
define('SCRIPT_DIR', realpath(dirname(__FILE__)));
define('ROOT_DIR',   realpath(dirname(__FILE__) . '/../'));

$cfg = require_once(ROOT_DIR . '/config.php');
  
// Remove the program name from argv
array_shift($argv);

  
// Get the function
$command = strtolower(array_shift($argv));


// If a function exists called `cmd_firstargument`, then call it
if(function_exists('cmd_' . $command)) {
  call_user_func('cmd_' . $command, $argv);
} else {
  echo "Unknown command '" . $command . ".'\n\n";
  showHelp();
  exit(-1);
}


/**
 * Executes Migrations
 */
function cmd_migrate($args) {
  echo "Executing migrations...\n";
  execInDir(SCRIPT_DIR, "php yiic.php migrate --interactive=0");
}

/**
 * Sets up the database
 */
function cmd_setup($args) {
  global $cfg;
  
  echo "Database Setup Utility\n";
  
  $cnx = dbConnect();
  $dbname = $cfg['db_name'];
  
  
  // Check to see if the database exists
  if($cnx->query("USE `$dbname`") === false) {
    $confirmation = confirm("Database `$dbname` does not exist; attempt to create database?", function() use($cnx,$dbname) {
      if($cnx->query("CREATE DATABASE `$dbname`") === false)
        exitWithError("Unable to create databse `$dbname`");
      echo "Database created.\n";
    });
    // Exit the setup if they chose not to create the database
    if(!$confirmation) exitWithAbort();
    
    // Now use the database
    $cnx->query("USE `$dbname`");
  }
  
  // Now run migrations
  cmd_migrate($args);
  
  
  // Now run the seed data
  //$seedSql = file_get_contents()
  
  echo "Finished Setting Up Database\n";

}

function cmd_update($args) {
  echo "Updating code from Git...\n";
  execInDir(ROOT_DIR, "git remote update");
  echo "Running migrations...\n";
  cmd_migrate($args);
}

function cmd_server($args) {
  if(version_compare(PHP_VERSION, '5.4', '<='))
    exitWithError("PHP Version must be at least 5.4");
  $host = 'localhost:8080';
  echo "PHP server started on $host in `" . PUBLIC_DIR . "`\n";
  system("cd " . escapeshellarg(PUBLIC_DIR) . " && php -S $host");
}


function showHelp() {
  echo "Available commands:\n" .
       " * setup - runs the setup script\n" .
       " * migrate - runs all available migrations\n" .
       " * update - Updates the code base from GIT and runs migrations\n" .
       " * server - Start a server (php 5.4 only)\n" ;
  
  echo "\n";
}

function exitWithError($string, $errCode = -1) {
  echo "Error: $string\n";
  exit($errCode);
}

function exitWithAbort($message = "Abort.", $errCode = -2) {
  echo "$message\n";
  exit($errCode);
}

function execInDir($dir, $command) {
  system('cd ' . escapeshellarg($dir) . ' && ' . $command);
}

/**
 * Connects to the database!
 */
function dbConnect() {
  global $cfg;
  
  $cnxstr = 'mysql:host=' . $cfg['db_host'];
  if(!empty($cfg['db_socket']))
    $cnxstr .= ';unix_socket=' . $cfg['db_socket'];
    
  try {
    return new PDO($cnxstr, $cfg['db_user'], $cfg['db_pass']);
  } catch(Exception $e) {
    exitWithError("Unable to connect to DB: " . $e->getMessage());
  }
}


/**
 * Confirmation. Executes the anonymous function if the user selects yes.
 * Returns true if the user selected "Y", false if "N"
 */
function confirm($text, $function) {
  echo "$text [y/N]: ";
  $confirm = strtolower(trim(fgets(STDIN)));
  if($confirm == 'y') {
    $function();
    return true;
  }
  return false;
}

?>