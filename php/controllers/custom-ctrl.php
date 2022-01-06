<?php

require_once "php/browser & DB/connect.php";


class Custom extends Connect {

   private $defaultColor = 'light-blue';


   function getCustom($userID) {
   
      $sql = "SELECT * FROM customs WHERE `userID` = :userID";

      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindValue(":userID", $userID, PDO::PARAM_INT);
      $request -> execute();
      
      $custom = $request -> fetch();
      return $custom;
   }
   

   function defaultCustom($userID) {
      $color = $this -> defaultColor;

      if(empty( $this -> getCustom($userID) )) {
         
         // Set default custom
         $sql = "INSERT INTO customs (
            userID,
            navClass,
            postClass,
            scrollClass)
            
            VALUES (
            '$userID',
            'nav-$color',
            'post-$color',
            'scroll-$color'
         )";
         
         $this -> dbConn() -> exec($sql);
      }

      return $this -> getCustom($userID);
   }
   

   function saveCustom($userClass, $reqArray) {

      $user = $userClass -> verifyToken();
      $DOM_ClassArray = $reqArray;
      
      foreach($DOM_ClassArray as $DOM_Class) {
         
         if($DOM_Class) {
            $column = array_search($DOM_Class, $DOM_ClassArray);
            
            try {
               $sql = "UPDATE customs SET $column = '$DOM_Class' WHERE userID = '$user[id]'";
               $this -> dbConn() -> exec($sql);

               // $sql = "UPDATE customs SET :column = :DOM_Class WHERE userID = :userID";

               // $request = $this -> dbConn() -> prepare($sql);
               // $request -> bindvalue(":column", $column, PDO::PARAM_STR);
               // $request -> bindvalue(":DOM_Class", $DOM_Class, PDO::PARAM_STR);
               // $request -> bindvalue(":userID", $user["id"], PDO::PARAM_INT);
               // $request -> execute();
            }

            catch(PDOException $except) {
               die($except -> getMessage());
            }
         }
      }
   }
}


$customClass = new Custom($env);