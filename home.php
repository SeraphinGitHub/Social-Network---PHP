<?php

$title = "Home";

$link = '
   <link rel="stylesheet" type="text/css" href="css/navbar.css">
   <link rel="stylesheet" type="text/css" href="css/newsFeed.css">
';
$script = '
   <script src="javascript/loadingHandler.js" async></script>
   <script src="javascript/navbarHandler.js" async></script>
';

// ===================================================================
// Scripts PHP
// ===================================================================
@require_once "connect.php";
@require_once "CRUD.php";


// ===================================================================
// Code
// ===================================================================
if(isset($_GET["id"])) {

   $userID = $_GET["id"];

   // Get user
   $sql = "SELECT * FROM users WHERE `id` = $userID";
   $request = $db -> query($sql);
   $user = $request -> fetch();
   
   // Get custom
   $sql = "SELECT * FROM customs WHERE `userID` = $userID";
   $request = $db -> query($sql);
   $custom = $request -> fetch();
   
   // Get newsFeed
   $sql = "SELECT * FROM posts";
   $request = $db -> query($sql);
   $posts = $request -> fetchAll();
}

// Save custom
if($stringResponse) {
   
   var_dump( $_GET["id"] );
   
   foreach($arrayResponse as $customClass) {
      if($customClass) {
         
         $column = array_search($customClass, $arrayResponse);
         
         try {
            $sql = "UPDATE customs SET $column = '$customClass' WHERE userID = 1";
            $request = $db -> exec($sql);
         }
         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }
   }
}


// ===================================================================
// HTML Templates
// ===================================================================
if(isset($_GET["id"])) {

   @require_once "PHP_Templates/_header.php";
   @require_once "PHP_Templates/_loadingSpinner.php";
   @require_once "PHP_Templates/_navbar.php";
   @require_once "PHP_Templates/_newsFeed.php";
   @require_once "PHP_Templates/_footer.php";
}