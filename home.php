<?php

$title = "Home";

$link = '
   <link rel="stylesheet" type="text/css" href="css/navbar.css">
';
$script = '
   <script src="javascript/loadingHandler.js" async></script>
   <script src="javascript/navbarHandler.js" async></script>
';

// ===================================================================
// Scripts PHP
// ===================================================================
@require_once "connect.php";


// ===================================================================
// Code
// ===================================================================
$userID = $_GET["id"];

// Get user
$sql = "SELECT * FROM users WHERE `id` = $userID";
$request = $db -> query($sql);
$user = $request -> fetch();

// Get custom
$sql = "SELECT * FROM customs WHERE `userID` = $userID";
$request = $db -> query($sql);
$custom = $request -> fetch();

// Save custom
if(isset($_POST["navClass"])) {
   try {
      // $sql = "UPDATE customs SET navBar = $_POST[navColor] WHERE userID = $userID";
      // $request = $db -> exec($sql);

      var_dump($_POST["navClass"]);
   }
   catch(PDOException $except) {
      die($except -> getMessage());
   }
}


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "PHP_Templates/_header.php";
@require_once "PHP_Templates/_loadingSpinner.php";
@require_once "PHP_Templates/_navbar.php";
@require_once "PHP_Templates/_footer.php";