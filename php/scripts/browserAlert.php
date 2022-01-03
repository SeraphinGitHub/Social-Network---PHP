<?php

// ===================================================================
// Disable browser refresh alert
// ===================================================================
session_start();

if(!empty( $_POST ) || !empty( $_FILES )) {

   $_SESSION["savePost"] = $_POST ;
   $_SESSION["saveFiles"] = $_FILES ;
   $fileToLoad = $_SERVER["PHP_SELF"] ;

   if(!empty( $_SERVER["QUERY_STRING"] )) $fileToLoad .= "?" . $_SERVER["QUERY_STRING"];
   
   header("Location: $fileToLoad");
   exit;
}

if(isset($_SESSION["savePost"])) {
   
   $_POST = $_SESSION["savePost"] ;
   $_FILES = $_SESSION["saveFiles"] ;
   unset($_SESSION["savePost"], $_SESSION["saveFiles"]);
}