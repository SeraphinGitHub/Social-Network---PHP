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
function searchForUser($db) {
   @require_once "PHP_Templates/_loadingSpinner.php";

   // Get user From Pseudo
   $sql = "SELECT * FROM users WHERE `userName` = '$_POST[userName]'";
   $request = $db -> query($sql);
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
@require_once "PHP_Templates/_header.php";
@require_once "PHP_Templates/_logPage.php";
@require_once "PHP_Templates/_footer.php";