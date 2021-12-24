<?php

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
// Search User
// ===================================================================
function searchUser() {
   @require_once "php/templates/_loadingSpinner.php";
   
   // Get user
   $user = getUserID("userName", $_POST["userName"]);

   echo '<script> window.addEventListener("load", () => enableSpinner() )</script>';

   if(!isset( $user ) || empty( $user )) {
      
      echo '<h1 class="flexCenter server-alert"> Utilisateur inexistant </h1>';
      echo '<script> window.addEventListener("load", () => disableSpinner() )</script>';
   }

   // if($user["email"] === $_POST["email"]
   // && $user["password"] === $_POST["password"]) {
      
   //    header("Location: home.php?id=$user[id]");
   //    exit;
   // }

   // if($user["email"] !== $_POST["email"]) {
   //    echo "Email invalide";
   // }
   
   // if($user["email"] !== $_POST["email"]) {
   //    echo "MdP invalide";
   // }

   else {
      header("Location: home.php?id=$user[id]");
      exit;
   }
}


// ===================================================================
// Login
// ===================================================================
if(isset($_POST["loginBtn"])) {

   if(isset($_POST["userName"]) && !empty($_POST["userName"])) {

   // if(isset($_POST["userName"]) && !empty($_POST["userName"])
   // && isset($_POST["email"]) && !empty($_POST["email"])
   // && isset($_POST["password"]) && !empty($_POST["password"])) {

      try {
         // Search user
         searchUser();
      }
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}


// ===================================================================
// Sign-in
// ===================================================================
if(isset($_POST["signinBtn"])) {

   if(isset($_POST["userName"]) && !empty($_POST["userName"])
   && isset($_POST["email"]) && !empty($_POST["email"])
   && isset($_POST["confirmEmail"]) && !empty($_POST["confirmEmail"])
   && isset($_POST["password"]) && !empty($_POST["password"])
   && isset($_POST["confirmPsw"]) && !empty($_POST["confirmPsw"])) {

      try {
         // Save user
         $sql = "INSERT INTO users (email, password) VALUES ($_POST[email], $_POST[password])";
         $db -> exec($sql);
         
         // Search user
         searchUser();
      }
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}