<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content, Accept, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

// ===================================================================
// Imported Scripts
// ===================================================================
require "php/controllers/user-ctrl.php";
require "php/controllers/custom-ctrl.php";
require "php/controllers/post-ctrl.php";


// ===================================================================
// Ajax Calls
// ===================================================================
session_start();
$user = $userClass -> verifyToken();

$reqStr = file_get_contents("php://input");
$reqArray = json_decode($reqStr, true);

if(isset( $user ) && !empty( $user )
&& isset( $reqArray ) && !empty( $reqArray )) {

   $name = $reqArray[0];
   $responseArray = $reqArray[1];

   // if($name === "logout") $userClass -> disconnectUser("Vous êtes déconnecté !");
   if($name === "custom") $customClass -> saveCustom($user, $responseArray);
   if($name === "publishPost") $postClass -> publishPost($user, $responseArray);
   if($name === "deletePost") $postClass -> deletePost($user, $responseArray);
   // if($name === "modifyPost") $postClass -> modifyPost($user, $responseArray);
}