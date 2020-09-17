<?php
require_once __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$serverName = $_ENV['DB_SERVER'];
$userName   = $_ENV['DB_USERNAME'];
$password   = $_ENV['DB_PASSWORD'];
$dbName     = $_ENV['DB_NAME'];

function connection($con)
{
   if ($con->connect_error) {
      die("Connection Failed: " . $con->connect_error);
   }
   echo "Database Connected";

   return $con;
}

function connectWithDb($dbName)
{
   global $serverName, $userName, $password;
   $con = new mysqli($serverName, $userName, $password, $dbName);
   connection($con);
}

function connectWithoutDb()
{
   global $serverName, $userName, $password;
   $con = new mysqli($serverName, $userName, $password);
   connection($con);
}
