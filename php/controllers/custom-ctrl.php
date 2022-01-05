<?php

require_once "php/browser & DB/connect.php";


class Custom extends Connect {

   public $defaultColor;
   
   function __construct() {
      $this -> defaultColor = 'light-blue';
   }


   function getCustom($USER_ID) {
   
      $sql = "SELECT * FROM customs WHERE `userID` = :userID";
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":userID", $USER_ID, PDO::PARAM_INT);
      $request -> execute();
      $custom = $request -> fetch();
      return $custom;
   }
   

   function defaultCustom($USER_ID) {
      $color = $this -> defaultColor;

      if(empty( $this -> getCustom($USER_ID) )) {
         
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
         
         Connect::dbConn() -> exec($sql);
      }

      return $this -> getCustom($USER_ID);
   }
   

   function saveCustom($REQ_ARRAY) {

      $customClassArray = $REQ_ARRAY[0];
      $paramID = $REQ_ARRAY[1]["id"];
      
      foreach($customClassArray as $customClass) {
         
         if($customClass) {
            $column = array_search($customClass, $customClassArray);
            
            try {
               $sql = "UPDATE customs SET $column = '$customClass' WHERE userID = $paramID";
               Connect::dbConn() -> exec($sql);
            }

            catch(PDOException $except) {
               die($except -> getMessage());
            }
         }
      }
   }
}


$customClass = new Custom();