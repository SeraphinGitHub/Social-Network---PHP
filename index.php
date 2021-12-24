<?php

$title = "Social Network";

$link = '
   <link rel="stylesheet" type="text/css" href="css/logPage.css">
';
$script = '
   <script src="javascript/loginHandler.js" async></script>
';

@require_once "php/templates/_header.php";

// ===================================================================
// Scripts PHP
// ===================================================================
require "php/controllers/user-ctrl.php";


// ===================================================================
// HTML Templates
// ===================================================================
@require_once "php/templates/_logPage.php";
@require_once "php/templates/_footer.php";