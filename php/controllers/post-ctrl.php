<?php

require_once "php/browser & DB/connect.php";


class Post extends Connect {

   function getAllPosts() {
      
      $sql = "SELECT * FROM posts";
      $request = $this -> dbConn() -> query($sql);
      $posts = $request -> fetchAll();

      krsort($posts);
      return $posts;
   }


   function getOnePost($postID) {
      
      $sql = "SELECT * FROM posts WHERE `id` = :postID";
      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindValue(":postID", $postID, PDO::PARAM_INT);
      $request -> execute();

      $post = $request -> fetch();
      return $post;
   }


   function getPostUserName($post) {
         
      $sql = "SELECT `userName` FROM users WHERE `id` = :userID";
      
      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindvalue(":userID", $post["userID"], PDO::PARAM_STR);
      $request -> execute();

      $userName = $request -> fetch();
      return $userName;
   }

   
   function publishPost($user, $responseArray) {

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
         }

         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }
   }


   function modifyPost($responseArray) {

      $postID = $responseArray["id"];
      $title = $responseArray["title"];
      $content = $responseArray["content"];

      if(isset( $title ) && !empty( $title )
      && filter_var( $title, FILTER_VALIDATE_REGEXP, $this -> textRegEx )
      && isset( $content ) && !empty( $content )
      && filter_var( $content, FILTER_VALIDATE_REGEXP, $this -> textRegEx )) {
      
         try {
            $sql = "UPDATE posts SET
               title = :title,
               content = :content,
               updatedAt = now()
               WHERE id = :postID
            ";
            
            $request = $this -> dbConn() -> prepare($sql);
            $request -> bindValue(":postID", $postID, PDO::PARAM_INT);
            $request -> bindValue(":title", $title, PDO::PARAM_STR);
            $request -> bindValue(":content", $content, PDO::PARAM_STR);
            $request -> execute();
         }

         catch(PDOException $except) {
            die($except -> getMessage());
         }
      }
   }


   function deletePost($user, $responseArray) {

      $postID = $responseArray["id"];
      
      if(isset( $postID ) && !empty( $postID )) {
         $post = $this -> getOnePost($postID);

         if($post["userID"] === $user["id"]) {

            try {
               $sql = "DELETE FROM posts WHERE `id` = :postID";
               
               $request = $this -> dbConn() -> prepare($sql);
               $request -> bindValue(":postID", $postID, PDO::PARAM_INT);
               $request -> execute();
            }
   
            catch(PDOException $except) {
               die($except -> getMessage());
            }
         }
      }
   }
}


$postClass = new Post($env);