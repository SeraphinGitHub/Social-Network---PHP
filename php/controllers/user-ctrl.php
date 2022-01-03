<?php

// ===================================================================
// Get user ID
// ===================================================================
function getUserID($WHERE, $VALUE) {
   require "php/scripts/connect.php";

   $sql = "SELECT id FROM users WHERE `$WHERE` = :b_value";
   $request = $db -> prepare($sql);
   $request -> bindValue(":b_value", $VALUE, PDO::PARAM_STR);
   $request -> execute();
   $user = $request -> fetch();
   return $user;
}


// ===================================================================
// Get user
// ===================================================================
function getUser($WHERE, $VALUE, $PARAM) {
   require "php/scripts/connect.php";

   $sql = "SELECT * FROM users WHERE `$WHERE` = :b_value";
   $request = $db -> prepare($sql);
   $request -> bindValue(":b_value", $VALUE, $PARAM);
   $request -> execute();
   $user = $request -> fetch();
   return $user;
}


// ===================================================================
// Save user
// ===================================================================
function saveUser($VALUE) {
   require "php/scripts/connect.php";

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

   $request = $db -> prepare($sql);
   $request -> bindValue(":userName", $VALUE["userName"], PDO::PARAM_STR);
   $request -> execute();
}


// ===================================================================
// Connect User
// ===================================================================
function connectUser($USER) {

   header("Location: home.php?id=$USER[id]");
   exit;
}


// ===================================================================
// Server Error Message
// ===================================================================
function serverErrorMsg($MSG) {
   
   echo "<h1 class='flexCenter server-alert'> $MSG </h1>";
}