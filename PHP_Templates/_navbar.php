
<nav class="flexCenter navBar nav-violet">

   <section class="flexCenter nav-left">
      <div class="flexCenter user-caption">
         <h2>Bonjour <?= $user["userName"] ?></h2>
         <h2><?= $user["email"] ?></h2>
      </div>

      <figure class="flexCenter user-picture">
         <img src="public/Default.jpg" alt="photo de profil">
      </figure>
   </section>

   <section class="flexCenter nav-center">
      <input type="text" placeholder="Rechercher un utilisateur">
   </section>

   <section class="flexCenter nav-right">
      <button class="btn settings-btn user-settings-btn">Paramètres utilisateur</button>
      <button class="btn settings-btn custom-color-btn">Personaliser</button>
         
      <div class="nav-colors-list">
         <button class="nav-orange">Orange NavBar</button>
         <button class="nav-violet">Violet NavBar</button>
         <button class="nav-light-blue">Light Blue NavBar</button>
         <button class="nav-dark-blue">Dark Blue NavBar</button>
         <button class="nav-green">Green NavBar</button>
      </div>
   </section>
</nav>