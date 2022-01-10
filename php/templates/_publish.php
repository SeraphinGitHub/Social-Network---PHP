
<!-- ========== Publish ========== -->
<section class="flexCenter publish <?= strip_tags( $custom["scrollClass"] )?> <?= strip_tags( $custom["publishClass"] )?>">
   <button class="btn btn-violet show-publish-btn" type="button">Exprimez-vous</button>

   <form class="flexCenter publish-field-container hide">
      <input autofocus type="text" name="title" id="title" placeholder="Titre de la publication">
      <textarea type="text" name="content" id="content" placeholder="Écrivez quelque chose"></textarea>
   </form>
   
   <div class="flexCenter btn-container hide">
      <button class="btn btn-violet hide-publish-btn" type="button">Réduire</button>
      <button class="btn orange-btn add-image-btn" type="button">Ajouter une image</button>
      <button class="btn green-btn publish-btn" type="button">Publier</button>
   </div>
</section>