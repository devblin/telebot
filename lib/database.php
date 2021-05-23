<?php
require_once __DIR__ . "/../connection.php";

class User
{
   private $userId, $chatId, $type;

   public function __construct()
   {}

   public function saveUser()
   {}

   public function checkUser()
   {}

   public function deleteUser()
   {}
}

class Database
{
   private $dbName;
   public function __construct($dbName)
   {
      $this->dbName = $dbName;
   }

   public function createTable($tableName)
   {
      global $con;
      connectWithDb($this->dbName);
      $sql = "CREATE TABLE $tableName(
         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         userId VARCHAR(20) NOT NULL,
         chatId VARCHAR(20) NOT NULL,
         userName VARCHAR(50) NOT NULL,
         firstName VARCHAR(50) NOT NULL,
         groupTitle VARCHAR(50) NOT NULL,
         type VARCHAR(20) NOT NULL,
      )";

      $status = $con->query($sql);
      $con->close();

      return $status;
   }

   public function dropDatabase()
   {
      global $con;
      connectWithoutDb();
      $sql    = "DROP DATABASE $this->dbName";
      $status = $con->query($sql);
      $con->close();

      return $status;
   }

   public function createDatabase()
   {
      connectWithoutDb();
      global $con;
      $sql    = "CREATE DATABASE $this->dbName";
      $status = $con->query($sql);
      $con->close();

      return $status;
   }
}
