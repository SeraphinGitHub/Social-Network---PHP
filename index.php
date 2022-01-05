<?php

$title = "Social Network";

$link = '
   <link rel="stylesheet" type="text/css" href="css/logPage.css">
';
$script = '
   <script src="javascript/logSystemHandler.js" async></script>
';

@require_once "php/templates/_header.php";

// ===================================================================
// Imported Scripts
// ===================================================================


// *************************************************
// require "php/browser & DB/initDB.php";
// $connectClass -> dbConn();
// *************************************************


require "php/browser & DB/initDB.php";
require "php/controllers/user-ctrl.php";

$initDBClass -> initialize();


// ===================================================================
// Login
// ===================================================================
if(isset( $_POST["loginBtn"] )) {
   
   $userClass -> login();
}


// ===================================================================
// Sign-in
// ===================================================================
if(isset( $_POST["signinBtn"] )) {
   
   $userClass -> signin();
}


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php/templates/_logPage.php";
@require_once "php/templates/_footer.php";