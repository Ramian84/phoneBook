<?php
session_start();

define("APPLICATION_NAME", "Phone Book");
define("APPLICATION_VERSION", "1.0.1-SNAPSHOT");

/* db server to connect to */
define ("DB_HOST","127.0.0.1");

/* db port to connect to */
define ("DB_PORT","33066");

define ("DB_USER","root");
define ("DB_PASS","");
define ("DB_NAME","agenda");




require_once('functions.php');
require_once('db.php');

?>