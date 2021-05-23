<?php
require_once __DIR__ . "/lib/database.php";

$db = new Database($dbName);
if ($db->createDatabase()) {
   echo "Database $dbName created!";
} else {
   echo "Database already exists!.";
   $input = readline("Do you want to drop existing database and create $dbName? [y/n]: ");
   if (strtolower($input) === "y") {
      if ($db->dropDatabase()) {
         echo "Database $dbName dropped!";
         if ($db->createDatabase()) {
            echo "Database $dbName created!";
            if ($db->createTable('users')) {
               echo "Users table created!";
            }
         }
      }
   } else {
      echo "Ok!";
   }
}
