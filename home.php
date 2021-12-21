<?php

$title = "Home";

$link = '
   <link rel="stylesheet" type="text/css" href="css/navbar.css">
   <link rel="stylesheet" type="text/css" href="css/newsFeed.css">
';
$script = '
   <script src="javascript/loadingHandler.js" async></script>
   <script src="javascript/customHandler.js" async></script>
';

// ===================================================================
// Scripts PHP
// ===================================================================
@require_once "connect.php";


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

   // if First time logged in
   if(empty( $custom )) {
      $color = 'light-blue';

      // Set custom
      $sql = "INSERT INTO customs (
         userID,
         navClass,
         postClass,
         scrollClass)
         
         VALUES (
         '$userID',
         'nav-$color',
         'post-$color',
         'scroll-$color'
      )";
      
      $request = $db -> exec($sql);

      // Get custom Again
      $sql = "SELECT * FROM customs WHERE `userID` = $userID";
      $request = $db -> query($sql);
      $custom = $request -> fetch();
   }

   
   // Get newsFeed
   $sql = "SELECT * FROM posts";
   $request = $db -> query($sql);
   $posts = $request -> fetchAll();
}

// Save custom
if($req_Str) {

   $customClassArray = $req_Array[0];
   $paramID = $req_Array[1]["id"];

   foreach($customClassArray as $customClass) {
      if($customClass) {
         
         $column = array_search($customClass, $customClassArray);
         
         try {
            $sql = "UPDATE customs SET $column = '$customClass' WHERE userID = $paramID";
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