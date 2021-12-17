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
function searchUser($dbArg) {
   @require_once "PHP_Templates/_loadingSpinner.php";

   // $aze = $_POST["email"];
   // var_dump($_POST["email"]);

   $sql = "SELECT `id` FROM users WHERE `email` = '$_POST[email]'";
   $request = $dbArg -> query($sql);
   $user = $request -> fetch();

   header("Location: home.php?id=$user[id]");
   exit;
}


if(isset($_POST["loginBtn"])) {

   try {
      searchUser($db);
   }

   catch(PDOException $except) {
      die($except -> getMessage());
   }
}

if(isset($_POST["signinBtn"])) {

   try {
      $sql = "INSERT INTO users (email, password) VALUES ($_POST[email], $_POST[password])";
      $request = $db -> exec($sql);
   
      searchUser($db);
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