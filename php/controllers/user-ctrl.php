<?php

require_once "php/browser & DB/connect.php";


class User extends Connect {

   private $textRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü_-]/"));
   private $pswRegEx = array("options" => array("regexp" => "/[A-Za-zÜ-ü0-9!@#$%^&*].{9,}/"));


   function login() {
      
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
         
         $this -> loginSigninBase( $state, $inputField, $errormessage );
      }
   }


   function checkForLogin($user, $inputField) {

      // Hash check
      $emailChecked = password_verify( $inputField["email"], $user["email"] );
      $passwordChecked = password_verify( $inputField["password"], $user["password"] );
      
      // Error messages
      if(!$emailChecked && $passwordChecked) $this -> serverErrorMsg("E-mail invalide !");
      if($emailChecked && !$passwordChecked) $this -> serverErrorMsg("Mot de passe invalide !");
      if(!$emailChecked && !$passwordChecked) $this -> serverErrorMsg("E-mail et Mot de passe invalides !");

      // if correct user informations
      if($emailChecked && $passwordChecked) $this -> connectUser($user);
   }


   function signin() {

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
         
         $this -> loginSigninBase( $state, $inputField, $errormessage );
      }
   }


   function checkForSignin($user, $inputField) {

      // Hash sensitive infos
      $emailHash = password_hash( $inputField["email"], PASSWORD_ARGON2ID );
      $passwordHash = password_hash( $inputField["password"], PASSWORD_ARGON2ID );
      
      $value = [
         "userName" => $inputField["userName"],
         "email" => $emailHash,
         "password" => $passwordHash,
         "isAdmin" => 0,
      ];

      // Save User
      $this -> saveUser($value);
      
      // Get User
      $user = $this -> getUserID("userName", $inputField["userName"]);

      // Connect User
      $this -> connectUser($user);
   }


   function loginSigninBase($state, $inputField, $message) {

      try {
         $user = $this -> getUser("userName", $inputField["userName"], PDO::PARAM_STR);

         // if User already exists
         if(isset( $user ) && !empty( $user )) {
            
            if($state === "login") $this -> checkForLogin($user, $inputField); // if exists ==> Can login
            if($state === "signin") $this -> serverErrorMsg($message); // if exists ==> Can't create new account
         }

         // if User doesn't exists
         else {
            if($state === "login") $this -> serverErrorMsg($message); // if not exists ==> Can't login
            if($state === "signin") $this -> checkForSignin($user, $inputField); // if not exists ==> Can create new account
         }
      }

      catch(PDOException $except) {
         die($except -> getmessage());
      }
   }   


   function getUserID($WHERE, $VALUE) {
   
      $sql = "SELECT id FROM users WHERE `$WHERE` = :b_value";
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":b_value", $VALUE, PDO::PARAM_STR);
      $request -> execute();
      $user = $request -> fetch();
      return $user;
   }
   
   
   function getUser($WHERE, $VALUE, $PARAM) {
   
      $sql = "SELECT * FROM users WHERE `$WHERE` = :b_value";
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":b_value", $VALUE, $PARAM);
      $request -> execute();
      $user = $request -> fetch();
      return $user;
   }
   
   
   function saveUser($VALUE) {
   
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
         '$VALUE[email]',
         '$VALUE[password]',
         '$VALUE[isAdmin]',
         now(),
         now()
      )";
   
      $request = Connect::dbConn() -> prepare($sql);
      $request -> bindValue(":userName", $VALUE["userName"], PDO::PARAM_STR);
      $request -> execute();
   }
   
   
   function connectUser($user) {
   
      header("Location: home.php?id=$user[id]");
      exit;
   }
   

   function serverErrorMsg($message) {
      echo "<h1 class='flexCenter server-alert'> $message </h1>";
   }
   
   function generateToken() {
      $token = bin2hex(random_bytes(64));
   }
}


$userClass = new User($env);