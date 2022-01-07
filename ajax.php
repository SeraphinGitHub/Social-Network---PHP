<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content, Accept, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

$req_Str = file_get_contents("php://input");
$req_Array = json_decode($req_Str, true);

// ===================================================================
// Imported Scripts
// ===================================================================
require "php/controllers/user-ctrl.php";
require "php/controllers/custom-ctrl.php";


// ===================================================================
// Ajax Calls
// ===================================================================
if(isset( $req_Str ) && !empty( $req_Str )) {
   
   session_start();

   if(strpos( $req_Str, "navClass" ) !== false) $customClass -> saveCustom($userClass, $req_Array);
   if(strpos( $req_Str, "logout" ) !== false) $userClass -> disconnectUser("Vous êtes déconnecté !");
}