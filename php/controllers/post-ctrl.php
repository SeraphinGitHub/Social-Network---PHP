<?php

require_once "php/browser & DB/connect.php";


class Post extends Connect {

   function getAllPosts() {
      
      $sql = "SELECT * FROM posts";
      $request = Connect::dbConn() -> query($sql);
      $posts = $request -> fetchAll();
      return $posts;
   }


   function getPostUserName($POST) {
         
      $sql = "SELECT `userName` FROM users WHERE `id` = $POST[userID]";
      $request = Connect::dbConn() -> query($sql);
      $userName = $request -> fetch();
      return $userName;
   }
}


$postClass = new Post($env);