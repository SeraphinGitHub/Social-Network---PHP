<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content, Accept, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

$req_Str = file_get_contents("php://input");
$req_Array = json_decode($req_Str, true);

// ===================================================================
// Scripts PHP
// ===================================================================
@require_once "env.php";


// ===================================================================
// Code
// ===================================================================
try {
   $db = new PDO("mysql:dbname=$DB_NAME;host=$DB_HOST", $DB_USER, $DB_PSW);
   $db -> exec("SET NAMES utf8");

   $db -> setAttribute(
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE,
      PDO::FETCH_ASSOC
   );
}

catch(PDOException $except) {
   die($except -> getMessage());
}


// ===================================================================
// Init DataBase
// ===================================================================
function initTable($DB, $TABLE_NAME, $SQL) {
   
   $sql = "SELECT id FROM $TABLE_NAME";
   $request = $DB -> query($sql);
   
   if(empty( $request )) {
      $request = $DB -> exec($SQL);
   }
}


// ===================================================================
// Init Users Table
// ===================================================================
$tableName = "users";

$sql = "CREATE TABLE $tableName (
   id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
   userName VARCHAR(255) UNIQUE NOT NULL,
   email VARCHAR(255) UNIQUE NOT NULL,
   password VARCHAR(255) NOT NULL,
   createdAt DATETIME NOT NULL,
   updatedAt DATETIME NOT NULL,

   PRIMARY KEY (id)
)";

initTable($db, $tableName, $sql);


// ===================================================================
// Init Posts Table
// ===================================================================
$tableName = "posts";

$sql = "CREATE TABLE $tableName (
   id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
   userID INT(11) NOT NULL,
   title VARCHAR(255) NOT NULL,
   content TEXT NOT NULL,
   imageURL VARCHAR(255),
   createdAt DATETIME NOT NULL,
   updatedAt DATETIME NOT NULL,

   PRIMARY KEY (id)
)";

initTable($db, $tableName, $sql);


// ===================================================================
// Init Comments Table
// ===================================================================
$tableName = "comments";

$sql = "CREATE TABLE $tableName (
   id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
   userID INT(11) NOT NULL,
   postID INT(11) NOT NULL,
   content TEXT NOT NULL,
   createdAt DATETIME NOT NULL,
   updatedAt DATETIME NOT NULL,

   PRIMARY KEY (id)
)";

initTable($db, $tableName, $sql);


// ===================================================================
// Init Customs Table
// ===================================================================
$tableName = "customs";

$sql = "CREATE TABLE $tableName (
   id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
   userID INT(11) NOT NULL,
   navClass VARCHAR(255) NOT NULL,
   postClass VARCHAR(255) NOT NULL,
   scrollClass VARCHAR(255) NOT NULL,
   
   PRIMARY KEY (id)
)";

initTable($db, $tableName, $sql);