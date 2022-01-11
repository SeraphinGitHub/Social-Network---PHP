<?php

require_once "php/browser & DB/connect.php";


class InitDB extends Connect {

   function initialize() {
      
      // $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES";
      // $request = $this -> dbConn() -> exec($sql);
      // var_dump( $request );

      // ===== Tables =====
      $this -> initUsers();
      $this -> initCustoms();
      $this -> initPosts();
      $this -> initComments();

      // ===== Admin =====
      $this -> initAdminUser();
   }


   function initAdminUser() {

      $adminName = $this -> admin_name;
      $adminState = $this -> admin_state;
      $adminEmailHash = password_hash( $this -> admin_email, PASSWORD_ARGON2ID );
      $adminPswHash = password_hash( $this -> admin_password, PASSWORD_ARGON2ID );

      $sql = "INSERT IGNORE INTO users (
         userName,
         email,
         password,
         isAdmin,
         createdAt,
         updatedAt)

         VALUES (
         '$adminName',
         '$adminEmailHash',
         '$adminPswHash',
         '$adminState',
         now(),
         now()
      )";

      $this -> dbConn() -> exec($sql);
   }
   

   function initUsers() {

      $tableName = "users";
      
      $sql = "CREATE TABLE IF NOT EXISTS $tableName (
         id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
         userName VARCHAR(255) UNIQUE NOT NULL,
         email VARCHAR(255) UNIQUE NOT NULL,
         password VARCHAR(255) NOT NULL,
         isAdmin TINYINT NOT NULL, 
         token VARCHAR(255),
         imageURL VARCHAR(255) NOT NULL,
         createdAt DATETIME NOT NULL,
         updatedAt DATETIME NOT NULL,
      
         PRIMARY KEY (id)
      )";
      
      $this -> dbConn() -> exec($sql);
   }
   

   function initCustoms() {

      $tableName = "customs";

      $sql = "CREATE TABLE IF NOT EXISTS $tableName (
         id INT(11) AUTO_INCREMENT UNIQUE NOT NULL,
         userID INT(11) UNIQUE NOT NULL,
         navClass VARCHAR(255) NOT NULL,
         postClass VARCHAR(255) NOT NULL,
         scrollClass VARCHAR(255) NOT NULL,
         publishClass VARCHAR(255) NOT NULL,
         
         PRIMARY KEY (id)
      )";

      $this -> dbConn() -> exec($sql);
   }
   
   
   function initPosts() {

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

      $this -> dbConn() -> exec($sql);
   }
   

   function initComments() {

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

      $this -> dbConn() -> exec($sql);
   }
}


$initDBClass = new InitDB($env);