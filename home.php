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
$userID = $_GET["id"];

if(!isset( $userID ) || empty( $userID )) {
   // header("Location: index.php");
   http_response_code(404);
   echo "<h1> Utilisateur inexistant </h1>";
   exit;
}


// Get user
$sql = "SELECT * FROM users WHERE `id` = :userID";
$request = $db -> prepare($sql);
$request -> bindValue(":userID", $userID, PDO::PARAM_INT);
$request -> execute();
$user = $request -> fetch();


// Get custom
function getCustom($DB, $USER_ID) {
   $sql = "SELECT * FROM customs WHERE `userID` = :userID";
   $request = $DB -> prepare($sql);
   $request -> bindValue(":userID", $USER_ID, PDO::PARAM_INT);
   $request -> execute();
   $custom = $request -> fetch();
   return $custom;
}

$custom = getCustom($db, $userID);


// if First time logged in
if(empty( $custom )) {
   $color = 'light-blue';

   // Set default custom
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
   $custom = getCustom($db, $userID);
}


// Get newsFeed
$sql = "SELECT * FROM posts";
$request = $db -> query($sql);
$posts = $request -> fetchAll();


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php_templates/_header.php";
@require_once "php_templates/_loadingSpinner.php";
@require_once "php_templates/_navbar.php";
@require_once "php_templates/_newsFeed.php";
@require_once "php_templates/_footer.php";