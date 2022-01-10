<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content, Accept, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

$reqStr = file_get_contents("php://input");
$reqArray = json_decode($reqStr, true);

// ===================================================================
// Imported Scripts
// ===================================================================
require "php/controllers/user-ctrl.php";
require "php/controllers/custom-ctrl.php";
require "php/controllers/post-ctrl.php";


// ===================================================================
// Ajax Calls
// ===================================================================
if(isset( $reqArray ) && !empty( $reqArray )) {
   
   $name = $reqArray[0];
   $responseArray = $reqArray[1];
   
   session_start();

   // if($name === "logout") $userClass -> disconnectUser("Vous êtes déconnecté !");
   if($name === "custom") $customClass -> saveCustom($userClass, $responseArray);
   if($name === "publish") $postClass -> publishPost($userClass, $responseArray);
}