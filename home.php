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
$id = $_GET["id"];

$sql = "SELECT * FROM users WHERE `id` = $id";
$request = $db -> query($sql);
$user = $request -> fetch();


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "PHP_Templates/_header.php";
@require_once "PHP_Templates/_loadingSpinner.php";
@require_once "PHP_Templates/_navbar.php";
@require_once "PHP_Templates/_footer.php";