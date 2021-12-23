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
require "php/scripts/connect.php";
require "php/controllers/user-ctrl.php";
require "php/controllers/custom-ctrl.php";
require "php/controllers/post-ctrl.php";


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
$user = getUser("id", $userID, PDO::PARAM_INT);

// Get custom
$custom = defaultCustom($userID);

// Get newsFeed
$posts = getAllPosts();


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php/templates/_header.php";
@require_once "php/templates/_loadingSpinner.php";
@require_once "php/templates/_navbar.php";
@require_once "php/templates/_newsFeed.php";
@require_once "php/templates/_footer.php";