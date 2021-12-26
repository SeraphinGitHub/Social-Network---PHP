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
// Connect User
// ===================================================================
function connectUser($USER) {
   @require_once "php/templates/_loadingSpinner.php";

   header("Location: home.php?id=$USER[id]");
   exit;
}


// ===================================================================
// Server Error Message
// ===================================================================
function serverErrorMsg($MSG) {
   
   echo '<script>
      window.addEventListener("load", () => {
         disableSpinner();
         disableServerAlert();
      })
   </script>';
   echo "<h1 class='flexCenter server-alert'> $MSG </h1>";
}


// ===================================================================
// RegEx
// ===================================================================
$textRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü_-]/"));
$pswRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü0-9!@#$%^&*].{9,}/"));


// ===================================================================
// Login
// ===================================================================
if(isset( $_POST["loginBtn"] )) {   

   $userName = $_POST["userName"];
   $email = $_POST["email"];
   $password = $_POST["password"];

   if(isset( $userName, $email, $password )
   && !empty( $userName ) && filter_var( $userName, FILTER_VALIDATE_REGEXP, $textRegEx )
   && !empty( $email ) && filter_var( $email, FILTER_VALIDATE_EMAIL )
   && !empty( $password ) && filter_var( $password, FILTER_VALIDATE_REGEXP, $pswRegEx )) {
      
      try {
         $user = getUser("userName", $userName, PDO::PARAM_STR);

         if(isset( $user ) && !empty( $user )) {

            $emailChecked = password_verify($_POST["email"], $user["email"]);
            $passwordChecked = password_verify($_POST["password"], $user["password"]);
            
            if($emailChecked && $passwordChecked) connectUser($user);
            if(!$emailChecked) serverErrorMsg("E-mail invalide !");
            if(!$passwordChecked) serverErrorMsg("Mot de passe invalide !");
            if(!$emailChecked && !$passwordChecked) serverErrorMsg("E-mail et Mot de passe invalides !");
         }
         else serverErrorMsg("Ce pseudo n'existe pas !");
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
         $user = getUser("userName", $userName, PDO::PARAM_STR);
         if(isset( $user ) && !empty( $user )) serverErrorMsg("Ce pseudo est déjà pris !");

         $emailHash = password_hash($email, PASSWORD_ARGON2ID);
         $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
         
         $value = [
            "userName" => $userName,
            "email" => $emailHash,
            "password" => $passwordHash,
         ];
         
         // Save User
         saveUser($value);
         
         // Get user
         $user = getUserID("userName", $userName);

         // Connect User
         connectUser($user);
      }
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}