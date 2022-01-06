<?php


class BrowserHandler {

   function createSession() {
      
      if(!isset( $_SESSION )) {
         
         $sessionLiftime = 48 *3600; // Hours
         // $sessionLiftime = 10; // Hours
         $path = "/";
         $domain = null;
         $secure = true;
         $httponly = true;
   
         session_set_cookie_params(
            $sessionLiftime,
            $path,
            $domain,
            $secure,
            $httponly
         );
         
         session_start();
         session_regenerate_id(true);
         
         $_SESSION["id"] = session_id();
      }
   }


   function disableAlert() {

      $this -> createSession();

      if(!empty( $_POST ) || !empty( $_FILES )) {

         $_SESSION["savePost"] = $_POST ;
         $_SESSION["saveFiles"] = $_FILES ;
         $fileToLoad = $_SERVER["PHP_SELF"] ;

         if(!empty( $_SERVER["QUERY_STRING"] )) $fileToLoad .= "?" . $_SERVER["QUERY_STRING"];
         
         header("Location: $fileToLoad");
         exit;
      }

      if(isset($_SESSION["savePost"])) {
         
         $_POST = $_SESSION["savePost"] ;
         $_FILES = $_SESSION["saveFiles"] ;
         unset($_SESSION["savePost"], $_SESSION["saveFiles"]);
      }
   }
}


$browserHandlerClass = new BrowserHandler();