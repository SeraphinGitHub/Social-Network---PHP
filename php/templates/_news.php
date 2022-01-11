
<!-- ========== News ========== -->
<ul class="flexCenter news news-height <?= strip_tags( $custom["scrollClass"]) ?>">
   
   <?php
      foreach($posts as $post):
         $userName = $postClass -> getPostUserName($post);
         $postUser = $userClass -> getUser("id", $post["userID"]);
   ?>

   <li class="flexCenter post <?= strip_tags( $custom["postClass"] )?>" id="<?= strip_tags( $post["id"] )?>">

      <figure class="flexCenter post-details">
         
         <!-- User Photo -->
         <img src="<?= strip_tags( $postUser["imageURL"] ) ?>">
         
         <figcaption class="flexCenter">
            
            <h2 class="flexCenter frame post-userName"><?= strip_tags( $userName[0] )?></h2>

            <h2 class="flexCenter frame post-title"><?= strip_tags( $post["title"] )?></h2>

            <?php
               if($post["createdAt"] === $post["updatedAt"]) { echo '
                  <h3 class="flexCenter frame post-time-stamp">
                     Publié le: '.date("d/m/Y à H:i:s", strtotime( $post["createdAt"] )).'
                  </h3>';
               }

               else { echo '
                  <h3 class="flexCenter frame post-time-stamp">
                     Modifié le: '.date("d/m/Y à H:i:s", strtotime( $post["updatedAt"] )).'
                  </h3> ';
               }
            ?>
         </figcaption>
         

         <!-- Buttons -->
         <?php
            if($post["userID"] === $user["id"]) { echo '
               <div class="flexCenter post-btn-container">
                  <button class="flexCenter btn orange-btn edit-btn" type="button">Modifier</button>
                  <button class="flexCenter btn red-btn delete-btn" type="button">Supprimer</button>
               </div>';
            }
         ?>         
         
      </figure>
            
      <!-- Text Content -->
      <p class="frame post-content"><?= strip_tags( $post["content"] )?></p>
   </li>

   <?php endforeach; ?>
</ul>
