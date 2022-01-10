
<!-- ========== News ========== -->
<ul class="flexCenter news news-height <?= strip_tags( $custom["scrollClass"]) ?>">
   
   <?php
      foreach($posts as $post):
         $userName = $postClass -> getPostUserName($post);
   ?>

   <li class="flexCenter post <?= strip_tags( $custom["postClass"] )?>" id="<?= strip_tags( $post["id"] )?>">

      <div class="flexCenter post-specs">
         <h2 class="frame post-title"><?= strip_tags( $post["title"] )?></h2>

         <?php
            if($post["createdAt"] === $post["updatedAt"]) { echo '
               <h3 class="frame post-time-stamp">
                  Publié le: '.date("d/m/Y à h:m:s", strtotime( $post["createdAt"] )).'
               </h3>';
            }

            else { echo '
               <h3 class="frame post-time-stamp">
                  Modifié le: '.date("d/m/Y à h:m:s", strtotime( $post["updatedAt"] )).'
               </h3> ';
            }
         ?>
      </div>
         
      <h2 class="frame post-user-caption"><?= strip_tags( $userName[0] )?></h2>
      <p class="frame post-content"><?= strip_tags( $post["content"] )?></p>

   </li>

   <?php endforeach; ?>
</ul>
