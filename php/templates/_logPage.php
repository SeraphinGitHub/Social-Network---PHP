
<!-- =============== Login =============== -->
<section class="flexCenter login-container">
   <button class="flexCenter btn create-account-btn">Créer un compte</button>

   <form class="flexCenter login-form" method="POST">

      <!-- UserName -->
      <div class="flexCenter field-div">
         <label for="logUserName">Pseudo</label>
         
         <input
            type="text" name="logUserName" placeholder="Entrer votre pseudo"
            autofocus value="<?= isset($_POST["logUserName"]) ? $_POST["logUserName"] : ""; ?>"
         >
      </div>

      <!-- Email -->
      <div class="flexCenter field-div">
         <label for="logEmail">Adresse E-mail</label>
         
         <input
            type="email" name="logEmail" placeholder="Entrer votre E-mail"
            value="<?= isset($_POST["logEmail"]) ? $_POST["logEmail"] : ""; ?>"
         >
      </div>
      
      <!-- Password -->
      <div class="flexCenter field-div">
         <label for="logPassword">Mot de passe</label>
         
         <input
            type="password" name="logPassword" placeholder="Entrer votre mot de passe"
            value="<?= isset($_POST["logPassword"]) ? $_POST["logPassword"] : ""; ?>"
         >
      </div>

      <button class="btn login-btn" type="submit" name="loginBtn">Se connecter</button>
   </form>
</section>



<!-- =============== Signin =============== -->
<section class="flexCenter signin-container hide">
   <button class="flexCenter btn back-btn">Retour</button>

   <form class="flexCenter signin-form" method="POST">

      <!-- UserName -->
      <div class="flexCenter field-div">
         <label for="signUserName">Pseudo</label>
         
         <input
            type="text" name="signUserName" placeholder="Entrer votre pseudo"
            autofocus value="<?= isset($_POST["signUserName"]) ? $_POST["signUserName"] : ""; ?>"
         >
      </div>

      <!-- Email -->
      <div class="flexCenter field-div">
         <label for="signEmail">Adresse E-mail</label>
         
         <input
            type="email" name="signEmail" placeholder="Entrer votre E-mail"
            value="<?= isset($_POST["signEmail"]) ? $_POST["signEmail"] : ""; ?>"
         >
      </div>

      <!-- Confirm Email -->
      <div class="flexCenter field-div">
         <label for="signConfirmEmail">Confirmation E-mail</label>
         
         <input
            type="email" name="signConfirmEmail" placeholder="Confirmer votre E-mail"
            value="<?= isset($_POST["signConfirmEmail"]) ? $_POST["signConfirmEmail"] : ""; ?>"
         >
      </div>
      
      <!-- Password -->
      <div class="flexCenter field-div">
         <label for="signPassword">Mot de passe</label>
         
         <input
            type="password" name="signPassword" placeholder="Entrer votre mot de passe"
            value="<?= isset($_POST["signPassword"]) ? $_POST["signPassword"] : ""; ?>"
         >
      </div>

      <!-- Confirm Password -->
      <div class="flexCenter field-div">
         <label for="signConfirmPsw">Confirmation mot de passe</label>
         
         <input
            type="password" name="signConfirmPsw" placeholder="Confirmer votre mot de passe"
            value="<?= isset($_POST["signConfirmPsw"]) ? $_POST["signConfirmPsw"] : ""; ?>"
         >
      </div>

      <button class="btn signin-btn" type="submit" name="signinBtn">S'inscrire</button>
   </form>
</section>