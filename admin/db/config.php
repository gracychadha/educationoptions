<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Gracy@2002');
define('DB_NAME', 'admin');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_select_db($db, DB_NAME);



?>
