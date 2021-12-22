<?php

$title = "Social Network";

$link = '
   <link rel="stylesheet" type="text/css" href="css/logPage.css">
';
$script = '
   <script src="javascript/loginHandler.js" async></script>
';

// ===================================================================
// Scripts PHP
// ===================================================================
@require_once "connect.php";


// ===================================================================
// Code
// ===================================================================
function searchForUser($DB) {
   @require_once "php_templates/_loadingSpinner.php";

   // Get user from UserName
   $sql = "SELECT * FROM users WHERE `userName` = :userName";
   $request = $DB -> prepare($sql);
   $request -> bindValue(":userName", $_POST["userName"], PDO::PARAM_STR);
   $request -> execute();
   $user = $request -> fetch();

   
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

   header("Location: home.php?id=$user[id]");
   exit;
}


// Login
if(isset($_POST["loginBtn"])) {

   // if(isset($_POST["userName"]) && !empty($_POST["userName"])
   // && isset($_POST["email"]) && !empty($_POST["email"])
   // && isset($_POST["password"]) && !empty($_POST["password"])) {

      try {
         // Get user
         searchForUser($db);
      }
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   // }
}


// Sign-in
if(isset($_POST["signinBtn"])) {

   if(isset($_POST["userName"]) && !empty($_POST["userName"])
   && isset($_POST["email"]) && !empty($_POST["email"])
   && isset($_POST["confirmEmail"]) && !empty($_POST["confirmEmail"])
   && isset($_POST["password"]) && !empty($_POST["password"])
   && isset($_POST["confirmPsw"]) && !empty($_POST["confirmPsw"])) {

      try {
         // Save user
         $sql = "INSERT INTO users (email, password) VALUES ($_POST[email], $_POST[password])";
         $request = $db -> exec($sql);
         
         // Get user
         searchForUser($db);
      }
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php_templates/_header.php";
@require_once "php_templates/_logPage.php";
@require_once "php_templates/_footer.php";