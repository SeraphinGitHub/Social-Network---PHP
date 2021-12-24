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
      createdAt,
      updatedAt)
      
      VALUES (
      :userName,
      '$VALUE[email]',
      '$VALUE[password]',
      now(),
      now()
   )";

   $request = $db -> prepare($sql);
   $request -> bindValue(":userName", $VALUE["userName"], PDO::PARAM_STR);
   $request -> execute();
}


// ===================================================================
// Search User
// ===================================================================
function searchUser() {
   @require_once "php/templates/_loadingSpinner.php";

   // Get user
   $user = getUserID("userName", $_POST["userName"]);
   
   if(!isset( $user ) || empty( $user )) {
      echo '<script>
         window.addEventListener("load", () => {
            disableSpinner();
            disableServerAlert();
         })
      </script>';
      echo '<h1 class="flexCenter server-alert"> Utilisateur inexistant </h1>';
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
if(isset( $_POST["loginBtn"] )) {

   if(isset($_POST["userName"]) && !empty($_POST["userName"])
   && isset($_POST["email"]) && !empty($_POST["email"])
   && isset($_POST["password"]) && !empty($_POST["password"])) {

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
if(isset( $_POST["signinBtn"] )) {

   $textRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü_-]/"));
   $pswRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü0-9!@#$%^&*].{9,}/"));

   $userName = $_POST["userName"];
   $email = $_POST["email"];
   $confirmEmail = $_POST["confirmEmail"];
   $password = $_POST["password"];
   $confirmPsw = $_POST["confirmPsw"];

   if(isset( $userName, $email, $confirmEmail, $password, $confirmPsw )
   && !empty( $userName ) && filter_var( $userName, FILTER_VALIDATE_REGEXP, $textRegEx )
   && !empty( $email ) && filter_var( $email, FILTER_VALIDATE_EMAIL )
   && !empty( $confirmEmail ) && filter_var( $confirmEmail, FILTER_VALIDATE_EMAIL )
   && !empty( $password ) && filter_var( $password, FILTER_VALIDATE_REGEXP, $pswRegEx )
   && !empty( $confirmPsw ) && filter_var( $confirmPsw, FILTER_VALIDATE_REGEXP, $pswRegEx )
   && $email === $confirmEmail
   && $password === $confirmPsw ) {

      try {
         $value = [
            "userName" => $userName,
            "email" => $email,
            "password" => $password,
         ];
         
         // Save User
         saveUser($value);
         
         // Search User
         searchUser();
      }
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}