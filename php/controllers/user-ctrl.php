<?php

require_once "php/browser & DB/connect.php";


class User extends Connect {

   function getUserID($WHERE, $VALUE) {
   
      $sql = "SELECT id FROM users WHERE `$WHERE` = :b_value";
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":b_value", $VALUE, PDO::PARAM_STR);
      $request -> execute();
      $user = $request -> fetch();
      return $user;
   }
   
   
   function getUser($WHERE, $VALUE, $PARAM) {
   
      $sql = "SELECT * FROM users WHERE `$WHERE` = :b_value";
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":b_value", $VALUE, $PARAM);
      $request -> execute();
      $user = $request -> fetch();
      return $user;
   }
   
   
   function saveUser($VALUE) {
   
      // Save user
      $sql = "INSERT INTO users (
         userName,
         email,
         password,
         isAdmin,
         createdAt,
         updatedAt)
         
         VALUES (
         :userName,
         '$VALUE[email]',
         '$VALUE[password]',
         '$VALUE[isAdmin]',
         now(),
         now()
      )";
   
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":userName", $VALUE["userName"], PDO::PARAM_STR);
      $request -> execute();
   }
   
   
   function connectUser($USER) {
   
      header("Location: home.php?id=$USER[id]");
      exit;
   }
   
   
   function generateToken() {
      $token = bin2hex(random_bytes(64));
   }
}


$userClass = new User($env);