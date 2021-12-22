<?php

// ===================================================================
// Scripts PHP
// ===================================================================
@require_once "connect.php";


// ===================================================================
// Code
// ===================================================================
if(isset( $req_Str ) && !empty( $req_Str )) {
   
   $customClassArray = $req_Array[0];
   $paramID = $req_Array[1]["id"];
   
   foreach($customClassArray as $customClass) {
      if($customClass) {
         
         $column = array_search($customClass, $customClassArray);
         
         try {
            $sql = "UPDATE customs SET $column = '$customClass' WHERE userID = $paramID";
            $request = $db -> exec($sql);
         }
         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }
   }
}
