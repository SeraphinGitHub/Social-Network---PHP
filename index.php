<?php

$title = "Social Network";

$link = '
   <link rel="stylesheet" type="text/css" href="css/logPage.css">
';
$script = '
   <script src="javascript/indexHandler.js" async></script>

   <!-- Dev Mode -->
   <script src="DEBUG_easyLogin.js" async></script>
   <!-- Dev Mode -->
';

@require_once "php/templates/_header.php";

// ===================================================================
// Imported Scripts
// ===================================================================
require "php/browser & DB/initDB.php";
require "php/controllers/user-ctrl.php";

// $initDBClass -> initialize();

// ===================================================================
// Code
// ===================================================================
if(isset( $_SESSION["servMess"] )) {
   $userClass -> serverErrorMsg( $_SESSION["servMess"] );
   $_SESSION["servMess"] = null;
}

if(isset( $_POST["loginBtn"] )) $userClass -> loginVerifyFields();
if(isset( $_POST["signinBtn"] )) $userClass -> signinVerifyFields();


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php/templates/_logPage.php";
@require_once "php/templates/_footer.php";