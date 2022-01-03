<?php

$title = "Social Network";

$link = '
   <link rel="stylesheet" type="text/css" href="css/logPage.css">
';
$script = '
   <script src="javascript/loginHandler.js" async></script>
';

@require_once "php/templates/_header.php";

// ===================================================================
// Scripts PHP
// ===================================================================
require "php/scripts/initDB.php";
require "php/scripts/connect.php";
require "php/controllers/user-ctrl.php";

initDB();


// ===================================================================
// RegEx
// ===================================================================
$textRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü_-]/"));
$pswRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü0-9!@#$%^&*].{9,}/"));


// ===================================================================
// Login
// ===================================================================
if(isset( $_POST["loginBtn"] )) {

   $userName = $_POST["logUserName"];
   $email = $_POST["logEmail"];
   $password = $_POST["logPassword"];

   if(isset( $userName, $email, $password )
   && !empty( $userName ) && filter_var( $userName, FILTER_VALIDATE_REGEXP, $textRegEx )
   && !empty( $email ) && filter_var( $email, FILTER_VALIDATE_EMAIL )
   && !empty( $password ) && filter_var( $password, FILTER_VALIDATE_REGEXP, $pswRegEx )) {
      
      try {

         $user = getUser("userName", $userName, PDO::PARAM_STR);

         if(isset( $user ) && !empty( $user )) {

            // Hash check
            $emailChecked = password_verify( $email, $user["email"] );
            $passwordChecked = password_verify( $password, $user["password"] );
            
            // Error messages
            if(!$emailChecked) serverErrorMsg("E-mail invalide !");
            if(!$passwordChecked) serverErrorMsg("Mot de passe invalide !");
            if(!$emailChecked && !$passwordChecked) serverErrorMsg("E-mail et Mot de passe invalides !");

            // if correct user informations
            if($emailChecked && $passwordChecked) connectUser($user);
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

   $userName = $_POST["signUserName"];
   $email = $_POST["signEmail"];
   $confirmEmail = $_POST["signConfirmEmail"];
   $password = $_POST["signPassword"];
   $confirmPsw = $_POST["signConfirmPsw"];

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

         // if User doesn't already exists
         if(!isset( $user ) || empty( $user )) {
            
            // Hash check
            $emailHash = password_hash( $email, PASSWORD_ARGON2ID );
            $passwordHash = password_hash( $password, PASSWORD_ARGON2ID );
            
            $value = [
               "userName" => $userName,
               "email" => $emailHash,
               "password" => $passwordHash,
               "isAdmin" => 0,
            ];

            // Save User
            saveUser($value);
            
            // Get user
            $user = getUserID("userName", $userName);
   
            // Connect User
            connectUser($user);
         }

         // if User already exists
         else serverErrorMsg("Ce pseudo est déjà pris !");
      }

      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php/templates/_logPage.php";
@require_once "php/templates/_footer.php";