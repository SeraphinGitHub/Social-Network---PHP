
<!DOCTYPE html>
<html lang="fr">
   
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" type="text/css" href="css/custom.css">
   <link rel="stylesheet" type="text/css" href="css/loadingSpinner.css">
   <?= $link ?>
   
   <script src="javascript/background.js" async></script>
   <?= $script ?>
   
   <title><?= $title ?></title>
</head>

<body class="flexCenter">


<?php
require "php/browser & DB/browserHandler.php";
$browserHandlerClass -> disableAlert();

@require_once "php/templates/_loadingSpinner.php";