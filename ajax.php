<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content, Accept, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

$req_Str = file_get_contents("php://input");
$req_Array = json_decode($req_Str, true);

// ===================================================================
// Imported Scripts
// ===================================================================
require "php/controllers/custom-ctrl.php";


// ===================================================================
// Ajax Calls
// ===================================================================
if(isset( $req_Str ) && !empty( $req_Str )) {

   $customClass -> saveCustom($req_Array);   
}