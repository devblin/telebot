<?php
require __DIR__ . "/autoload.php";
date_default_timezone_set("Asia/Kolkata");
$servername = env('LOCAL_HOST');
$username = env('DB_USERNAME');
$password = env('DB_PASSWORD');
$dbname = env('DB_NAME');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}