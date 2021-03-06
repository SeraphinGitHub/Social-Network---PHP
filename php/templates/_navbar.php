
<!-- ========== NavBar ========== -->
<nav class="flexCenter nav-bar <?= strip_tags( $custom["navClass"] )?>">

   <!-- Nav Left -->
   <section class="flexCenter nav-left">
      <div class="flexCenter user-caption">
         <h2>Bonjour <?= strip_tags( $user["userName"] )?></h2>
         <h2><?= strip_tags( $_SESSION["email"] ) ?></h2>
      </div>

      <figure class="flexCenter user-picture">
         <img src="<?= strip_tags( $user["imageURL"] ) ?>">
      </figure>
   </section>

   <!-- Nav Center -->
   <section class="flexCenter nav-center">
      <input type="text" placeholder="Rechercher un utilisateur">
   </section>

   <!-- Nav Right -->
   <section class="flexCenter nav-right">
      <button class="btn settings-btn user-settings-btn">Paramètres utilisateur</button>
      <button class="btn settings-btn custom-color-btn">Personaliser</button>
         
      <div class="colors-list">
         <button class="nav-orange">Orange</button>
         <button class="nav-red">Red</button>
         <button class="nav-violet">Violet</button>
         <button class="nav-light-blue">Light Blue</button>
         <button class="nav-dark-blue">Dark Blue</button>
         <button class="nav-green">Green</button>
      </div>

      <form class="flexCenter" method="POST">
         <button class="flexCenter btn logout-btn" type="submit" name="logout">
            <i class="fas fa-power-off"></i>
         </button>
      </form>
   </section>
</nav>