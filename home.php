<?php

$title = "Home";

$link = '
   <link rel="stylesheet" type="text/css" href="css/navbar.css">
   <link rel="stylesheet" type="text/css" href="css/news.css">
';
$script = '
   <script src="javascript/customHandler.js" async></script>
';

@require_once "php/templates/_header.php";

// ===================================================================
// Imported Scripts
// ===================================================================
require_once "php/browser & DB/connect.php";
require "php/controllers/user-ctrl.php";
require "php/controllers/custom-ctrl.php";
require "php/controllers/post-ctrl.php";


// ===================================================================
// Code
// ===================================================================
$userID = $_GET["id"];

// Get user
$user = $userClass -> getUser("id", $userID, PDO::PARAM_INT);

// Get custom
$custom = $customClass -> defaultCustom($userID);

// Get news
$posts = $postClass -> getAllPosts();


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php/templates/_navbar.php";
@require_once "php/templates/_news.php";
@require_once "php/templates/_footer.php";