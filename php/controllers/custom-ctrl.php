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
            scrollClass,
            publishClass)
            
            VALUES (
            '$userID',
            'nav-$color',
            'post-$color',
            'scroll-$color',
            'publish-$color'
         )";
         
         $this -> dbConn() -> exec($sql);
      }

      return $this -> getCustom($userID);
   }
   

   function saveCustom($user, $responseArray) {
      
      $navClass = $responseArray["navClass"];
      $postClass = $responseArray["postClass"];
      $scrollClass = $responseArray["scrollClass"];
      $publishClass = $responseArray["publishClass"];
      
      if(isset( $navClass ) && !empty( $navClass )
      && isset( $postClass ) && !empty( $postClass )
      && isset( $scrollClass ) && !empty( $scrollClass )
      && isset( $publishClass ) && !empty( $publishClass )) {
         
         try {
            $sql = "UPDATE customs SET
               navClass = :navClass,
               postClass = :postClass,
               scrollClass = :scrollClass,
               publishClass = :publishClass
               WHERE userID = :userID
            ";
            
            $request = $this -> dbConn() -> prepare($sql);

            $request -> bindvalue(":userID", $user["id"], PDO::PARAM_INT);
            $request -> bindvalue(":navClass", $navClass, PDO::PARAM_STR);
            $request -> bindvalue(":postClass", $postClass, PDO::PARAM_STR);
            $request -> bindvalue(":scrollClass", $scrollClass, PDO::PARAM_STR);
            $request -> bindvalue(":publishClass", $publishClass, PDO::PARAM_STR);

            $request -> execute();
         }

         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }         
   }
}


$customClass = new Custom($env);