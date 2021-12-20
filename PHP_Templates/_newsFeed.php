
<ul class="flexCenter news-feed <?= $custom["scrollClass"] ?>">
   
   <?php      
      foreach($posts as $post):

      $sql = "SELECT `userName` FROM users WHERE `id` = $post[userID]";
      $request = $db -> query($sql);
      $userName = $request -> fetch();
   ?>

   <li class="flexCenter post <?= $custom["postClass"] ?>" id="<?= $post["id"] ?>">
      <h2><?= $userName[0] ?></h2>
      <h2><?= $post["title"] ?></h2>
      <p><?= $post["content"] ?></p>
   </li>

   <?php endforeach; ?>
</ul>
