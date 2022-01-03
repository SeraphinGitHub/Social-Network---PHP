<?php

// ===================================================================
// Init Admin User
// ===================================================================
function initAdminUser() {
   require "env.php";
   require "php/scripts/connect.php";
   
   $adminEmailHash = password_hash( $ADMIN["email"], PASSWORD_ARGON2ID );
   $adminPswHash = password_hash( $ADMIN["password"], PASSWORD_ARGON2ID );

   $sql = "INSERT IGNORE INTO users (
      userName,
      email,
      password,
      isAdmin,
      createdAt,
      updatedAt)
      
      VALUES (
      '$ADMIN[userName]',
      '$adminEmailHash',
      '$adminPswHash',
      '$ADMIN[isAdmin]',
      now(),
      now()
   )";

   $db -> exec($sql);
}


// ===================================================================
// Init DB
// ===================================================================
function initDB() {
   
   // Tables
   initUsers();
   initCustoms();
   initPosts();
   initComments();

   // Admin
   initAdminUser();
}


// ===================================================================
// Init Users Table
// ===================================================================
function initUsers() {
   require "php/scripts/connect.php";

   $tableName = "users";
   
   $sql = "CREATE TABLE IF NOT EXISTS $tableName (
      id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
      userName VARCHAR(255) UNIQUE NOT NULL,
      email VARCHAR(255) UNIQUE NOT NULL,
      password VARCHAR(255) NOT NULL,
      isAdmin TINYINT NOT NULL, 
      createdAt DATETIME NOT NULL,
      updatedAt DATETIME NOT NULL,
   
      PRIMARY KEY (id)
   )";
   
   $db -> exec($sql);
}


// ===================================================================
// Init Customs Table
// ===================================================================
function initCustoms() {
   require "php/scripts/connect.php";

   $tableName = "customs";

   $sql = "CREATE TABLE IF NOT EXISTS $tableName (
      id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
      userID INT(11) UNIQUE NOT NULL,
      navClass VARCHAR(255) NOT NULL,
      postClass VARCHAR(255) NOT NULL,
      scrollClass VARCHAR(255) NOT NULL,
      
      PRIMARY KEY (id)
   )";

   $db -> exec($sql);
}


// ===================================================================
// Init Posts Table
// ===================================================================
function initPosts() {
   require "php/scripts/connect.php";

   $tableName = "posts";

   $sql = "CREATE TABLE IF NOT EXISTS $tableName (
      id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
      userID INT(11) NOT NULL,
      title VARCHAR(255) NOT NULL,
      content TEXT NOT NULL,
      imageURL VARCHAR(255),
      createdAt DATETIME NOT NULL,
      updatedAt DATETIME NOT NULL,

      PRIMARY KEY (id)
   )";

   $db -> exec($sql);
}


// ===================================================================
// Init Comments Table
// ===================================================================
function initComments() {
   require "php/scripts/connect.php";

   $tableName = "comments";

   $sql = "CREATE TABLE IF NOT EXISTS $tableName (
      id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
      userID INT(11) NOT NULL,
      postID INT(11) NOT NULL,
      content TEXT NOT NULL,
      createdAt DATETIME NOT NULL,
      updatedAt DATETIME NOT NULL,

      PRIMARY KEY (id)
   )";

   $db -> exec($sql);
}