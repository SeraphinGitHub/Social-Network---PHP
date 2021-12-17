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

   // Get user
   $sql = "SELECT `id` FROM users WHERE `email` = '$_POST[email]'";
   $request = $db -> query($sql);
   $user = $request -> fetch();

   header("Location: home.php?id=$user[id]");
   exit;
}


// Login
if(isset($_POST["loginBtn"])) {
   try {
      // Get user
      searchForUser($db);
   }
   catch(PDOException $except) {
      die($except -> getMessage());
   }
}

// Sign-in
if(isset($_POST["signinBtn"])) {
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


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "PHP_Templates/_header.php";
@require_once "PHP_Templates/_logPage.php";
@require_once "PHP_Templates/_footer.php";