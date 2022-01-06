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
}


$postClass = new Post($env);