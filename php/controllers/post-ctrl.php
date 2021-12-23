<?php

// ===================================================================
// Get all posts
// ===================================================================
function getAllPosts() {
   require "php/scripts/connect.php";

   $sql = "SELECT * FROM posts";
   $request = $db -> query($sql);
   $posts = $request -> fetchAll();
   return $posts;
}