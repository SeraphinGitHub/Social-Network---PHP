<?php

require_once "php/browser & DB/connect.php";


class Post extends Connect {

   function getAllPosts() {
      
      $sql = "SELECT * FROM posts";
      $request = $this -> dbConn() -> query($sql);
      $posts = $request -> fetchAll();
      return $posts;
   }


   function getPostUserName($post) {
         
      $sql = "SELECT `userName` FROM users WHERE `id` = :userID";
      
      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindvalue(":userID", $post["userID"], PDO::PARAM_STR);
      $request -> execute();

      $userName = $request -> fetch();
      return $userName;
   }

   
   function publishPost($userClass, $responseArray) {

      $user = $userClass -> verifyToken();

      $title = $responseArray["title"];
      $content = $responseArray["content"];

      if(isset( $title ) && !empty( $title )
      && filter_var( $title, FILTER_VALIDATE_REGEXP, $this -> textRegEx )
      && isset( $content ) && !empty( $content )
      && filter_var( $content, FILTER_VALIDATE_REGEXP, $this -> textRegEx )) {
      
         try {
            $sql = "INSERT INTO posts (
               userID,
               title,
               content,
               imageURL,
               createdAt,
               updatedAt)

               VALUES (
               :userID,
               :title,
               :content,
               '',
               now(),
               now()
            )";
            
            $request = $this -> dbConn() -> prepare($sql);
            $request -> bindValue(":userID", $user["id"], PDO::PARAM_INT);
            $request -> bindValue(":title", $title, PDO::PARAM_STR);
            $request -> bindValue(":content", $content, PDO::PARAM_STR);
            $request -> execute();

            // $this -> getAllPosts();
         }

         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }
   }
}


$postClass = new Post($env);