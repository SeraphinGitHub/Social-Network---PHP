<?php

// ===================================================================
// Init DataBase
// ===================================================================
function initDataBase($DB) {
   
   initUsers($DB);
   initCustoms($DB);
   initPosts($DB);
   initComments($DB);
}


// ===================================================================
// Init Base Table
// ===================================================================
function initTable_Base($DB, $TABLE_NAME, $SQL) {
   
   $sql = "SELECT id FROM $TABLE_NAME";
   $request = $DB -> query($sql);
   
   if(empty( $request )) {
      $request = $DB -> exec($SQL);
   }
}


// ===================================================================
// Init Users Table
// ===================================================================
function initUsers($DB) {

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
   
   initTable_Base($DB, $tableName, $sql);
}


// ===================================================================
// Init Customs Table
// ===================================================================
function initCustoms($DB) {
   $tableName = "customs";

   $sql = "CREATE TABLE $tableName (
      id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
      userID INT(11) NOT NULL,
      navClass VARCHAR(255) NOT NULL,
      postClass VARCHAR(255) NOT NULL,
      scrollClass VARCHAR(255) NOT NULL,
      
      PRIMARY KEY (id)
   )";

   initTable_Base($DB, $tableName, $sql);
}


// ===================================================================
// Init Posts Table
// ===================================================================
function initPosts($DB) {
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

   initTable_Base($DB, $tableName, $sql);
}


// ===================================================================
// Init Comments Table
// ===================================================================
function initComments($DB) {
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

   initTable_Base($DB, $tableName, $sql);
}