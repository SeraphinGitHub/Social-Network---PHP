<?php

// ===================================================================
// Get custom
// ===================================================================
function getCustom($USER_ID) {
   require "php/scripts/connect.php";

   $sql = "SELECT * FROM customs WHERE `userID` = :userID";
   $request = $db -> prepare($sql);
   $request -> bindValue(":userID", $USER_ID, PDO::PARAM_INT);
   $request -> execute();
   $custom = $request -> fetch();
   return $custom;
}


// ===================================================================
// Default Custom
// ===================================================================
function defaultCustom($USER_ID) {
   require "php/scripts/connect.php";
   
   if(empty( getCustom($USER_ID) )) {
      $color = 'light-blue';
      
      // Set default custom
      $sql = "INSERT INTO customs (
         userID,
         navClass,
         postClass,
         scrollClass)
         
         VALUES (
         '$USER_ID',
         'nav-$color',
         'post-$color',
         'scroll-$color'
      )";
      
      $db -> exec($sql);
   }
   return getCustom($USER_ID);
}


// ===================================================================
// Save Custom
// ===================================================================
function saveCustom($REQ_ARRAY) {
   require "php/scripts/connect.php";

   $customClassArray = $REQ_ARRAY[0];
   $paramID = $REQ_ARRAY[1]["id"];
   
   foreach($customClassArray as $customClass) {
      if($customClass) {
         
         $column = array_search($customClass, $customClassArray);
         
         try {
            $sql = "UPDATE customs SET $column = '$customClass' WHERE userID = $paramID";
            $db -> exec($sql);
         }
         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }
   }
}