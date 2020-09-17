<?php
$variables = [
    'DB_NAME' => 'BOT_DB_NAME',
    'DB_PASSWORD' => 'YOUR_DB_PASSWORD',
    'DB_USERNAME' => 'YOU_DB_USERNAME',
    'API_KEY' => 'YOUR_API_KEY',
];
foreach ($variables as $key => $val) {
    putenv("$key=$val");
}