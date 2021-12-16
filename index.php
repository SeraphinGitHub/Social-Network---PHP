<?php
   $title = "Social Network";

   $script = "
      <script src='javascript/loginHandler.js' async></script>
   ";
   
   @require_once "PHP_Templates/_header.php";
   // @require_once "PHP_Templates/_loadingSpinner.php";
?>

<section class="flexCenter login-container">
   <button class="flexCenter btn create-account-btn">Créer un compte</button>

   <form class="flexCenter login-form" method="POST">
      <div class="flexCenter field-div">
         <label for="email">Adresse E-mail</label>
         <input type="email" name="email" id="email" placeholder="Entrer votre E-mail">
      </div>
      
      <div class="flexCenter field-div">
         <label for="password">Mot de passe</label>
         <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe">
      </div>

      <button class="btn login-btn" type="submit" name="loginBtn">Se connecter</button>
   </form>
</section>

<section class="flexCenter signin-container hide">
   <button class="flexCenter btn back-btn">Retour</button>

   <form class="flexCenter signin-form" method="POST">
      <div class="flexCenter field-div">
         <label for="email">Adresse E-mail</label>
         <input type="email" name="email" id="email" placeholder="Entrer votre E-mail">
      </div>

      <div class="flexCenter field-div">
         <label for="confirmEmail">Confirmation E-mail</label>
         <input type="email" name="confirmEmail" id="confirmEmail" placeholder="Confirmer votre E-mail">
      </div>
      
      <div class="flexCenter field-div">
         <label for="password">Mot de passe</label>
         <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe">
      </div>

      <div class="flexCenter field-div">
         <label for="confirmPsw">Confirmation mot de passe</label>
         <input type="password" name="confirmPsw" id="confirmPsw" placeholder="Confirmer votre mot de passe">
      </div>

      <button class="btn signin-btn" type="submit" name="signinBtn">S'inscrire</button>
   </form>
</section>

<?php
@require_once "PHP_Templates/_footer.php";
@require_once "connect.php";

if(isset($_POST['loginBtn']) || isset($_POST['signinBtn'])) {

   if(isset($_POST['loginBtn'])) $id = 1;

   if(isset($_POST['signinBtn'])) $id = 2;

   // @require_once "PHP_Templates/_loadingSpinner.php";

   header("Location: home.php?id=$id");
   exit;
   
   // $sql = "INSERT INTO users (email, password) VALUES ('test@azerty.com', '1234')";
   // $stmt = $db -> exec($sql);
}

