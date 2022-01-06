<?php

require_once "php/browser & DB/connect.php";


class User extends Connect {

   private $textRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü_-]/"));
   private $pswRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü0-9!@#$%^&*].{9,}/"));


   function loginVerifyFields() {
      
      $userName = $_POST["logUserName"];
      $email = $_POST["logEmail"];
      $password = $_POST["logPassword"];

      $state = "login";
      $errormessage = "Pseudo incorrect !";
      
      $inputField = array (
         "userName" => $userName,
         "email" => $email,
         "password" => $password,
      );
      

      // Login Verify
      if(isset( $userName, $email, $password )
      && !empty( $userName ) && filter_var( $userName, FILTER_VALIDATE_REGEXP, $this -> textRegEx )
      && !empty( $email ) && filter_var( $email, FILTER_VALIDATE_EMAIL )
      && !empty( $password ) && filter_var( $password, FILTER_VALIDATE_REGEXP, $this -> pswRegEx )) {
         
         $this -> verifyUserExist( $state, $inputField, $errormessage );
      }
   }
   

   function signinVerifyFields() {

      $userName = $_POST["signUserName"];
      $email = $_POST["signEmail"];
      $confirmEmail = $_POST["signConfirmEmail"];
      $password = $_POST["signPassword"];
      $confirmPsw = $_POST["signConfirmPsw"];

      $state = "signin";
      $errormessage = "Ce pseudo est déjà pris !";
      
      $inputField = array (
         "userName" => $userName,
         "email" => $email,
         "confEmail" => $confirmEmail,
         "password" => $password,
         "confPsw" => $confirmPsw,
      );


      // Sigin Verify
      if(isset( $userName, $email, $confirmEmail, $password, $confirmPsw )
      && !empty( $userName ) && filter_var( $userName, FILTER_VALIDATE_REGEXP, $this -> textRegEx )
      && !empty( $email ) && filter_var( $email, FILTER_VALIDATE_EMAIL )
      && !empty( $confirmEmail ) && filter_var( $confirmEmail, FILTER_VALIDATE_EMAIL )
      && !empty( $password ) && filter_var( $password, FILTER_VALIDATE_REGEXP, $this -> pswRegEx )
      && !empty( $confirmPsw ) && filter_var( $confirmPsw, FILTER_VALIDATE_REGEXP, $this -> pswRegEx )
      && $email === $confirmEmail
      && $password === $confirmPsw ) {
         
         $this -> verifyUserExist( $state, $inputField, $errormessage );
      }
   }


   function verifyUserExist($state, $inputField, $message) {

      try {
         $user = $this -> getUser("userName", $inputField["userName"]);
         
         // if User already exists
         if(isset( $user ) && !empty( $user )) {           
            
            if($state === "login") $this -> connectFromLogin($user, $inputField); // if exists ==> Can login
            if($state === "signin") $this -> serverErrorMsg($message); // if exists ==> Can't create new User
         }

         // if User doesn't exists
         else {
            if($state === "login") $this -> serverErrorMsg($message); // if not exists ==> Can't login
            if($state === "signin") $this -> connectFromSignin($inputField); // if not exists ==> Can create new User
         }
      }

      catch(PDOException $except) {
         die($except -> getmessage());
      }
   }


   function connectFromLogin($user, $inputField) {

      // Hash check
      $emailChecked = password_verify( $inputField["email"], $user["email"] );
      $passwordChecked = password_verify( $inputField["password"], $user["password"] );
      
      // Error messages
      if(!$emailChecked && $passwordChecked) $this -> serverErrorMsg("E-mail invalide !");
      if($emailChecked && !$passwordChecked) $this -> serverErrorMsg("Mot de passe invalide !");
      if(!$emailChecked && !$passwordChecked) $this -> serverErrorMsg("E-mail et Mot de passe invalides !");
      
      // if correct user informations
      if($emailChecked && $passwordChecked) $this -> connectUser($inputField["userName"]);
   }
   

   function connectFromSignin($inputField) {
      
      // Hash sensitive infos
      $emailHash = password_hash( $inputField["email"], PASSWORD_ARGON2ID );
      $passwordHash = password_hash( $inputField["password"], PASSWORD_ARGON2ID );
      
      $userArray = [
         "userName" => $inputField["userName"],
         "email" => $emailHash,
         "password" => $passwordHash,
         "isAdmin" => 0,
      ];
      
      $this -> saveUser($userArray);
      $this -> connectUser($inputField["userName"]);
   }


   function getUserID($where, $value) {
   
      $sql = "SELECT id FROM users WHERE `$where` = :b_value";

      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindValue(":b_value", $value, PDO::PARAM_STR);
      $request -> execute();
      
      $user = $request -> fetch();
      return $user;
   }
   
   
   function getUser($where, $value) {
   
      $sql = "SELECT * FROM users WHERE `$where` = :b_value";

      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindValue(":b_value", $value, PDO::PARAM_STR);
      $request -> execute();
      
      $user = $request -> fetch();
      return $user;
   }
   
   
   function saveUser($userArray) {
   
      // Save User
      $sql = "INSERT INTO users (
         userName,
         email,
         password,
         isAdmin,
         createdAt,
         updatedAt)
         
         VALUES (
         :userName,
         '$userArray[email]',
         '$userArray[password]',
         '$userArray[isAdmin]',
         now(),
         now()
      )";
      
      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindValue(":userName", $userArray["userName"], PDO::PARAM_STR);
      $request -> execute();
   }


   function connectUser($userName) {
      
      $this -> generateToken($userName);
      header("Location: home.php");
      exit;
   }


   function disconnectUser($message) {

      $_SESSION["servMess"] = $message;
      header("Location: index.php");
      exit;
   }


   function generateToken($userName) {

      $token = bin2hex(random_bytes(64));
      $tokenHash = password_hash( $token, PASSWORD_ARGON2ID );
      
      // Save Token in Session
      $_SESSION["userName"] = $userName;
      $_SESSION["token"] = $token;
      
      // Save Token in DB
      $sql = "UPDATE users SET token = :token WHERE `userName` = :userName";

      $request = $this -> dbConn() -> prepare($sql);
      $request -> bindValue(":token", $tokenHash, PDO::PARAM_STR);
      $request -> bindValue(":userName", $userName, PDO::PARAM_STR);
      $request -> execute();
   }


   function verifyToken() {

      $token = $_SESSION["token"];
      $userName = $_SESSION["userName"];

      $user = $this -> getUser("userName", $userName);
      $tokenChecked = password_verify( $token, $user["token"] );

      if( $tokenChecked ) return $user;
      else $this -> disconnectUser("Session expirée !");
   }
   

   function serverErrorMsg($message) {
      echo "<h1 class='flexCenter server-alert'> $message </h1>";
   }
}


$userClass = new User($env);