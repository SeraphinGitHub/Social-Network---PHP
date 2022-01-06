<?php

require "env.php";

$env = array(

   // DataBase
   "db_name" => DB_NAME,
   "db_user" => DB_USER,
   "db_password" => DB_PSW,
   "db_host" => DB_HOST,

   // Admin
   "admin_name" => ADMIN_NAME,
   "admin_email" => ADMIN_EMAIL,
   "admin_password" => ADMIN_PASSWORD,
   "admin_state" => ADMIN_STATE,
);


class Connect {

   private $db_name;
   private $db_user;
   private $db_password;
   private $db_host;

   protected $admin_name;
   protected $admin_email;
   protected $admin_password;
   protected $admin_state;

   public function __construct($env) {

      $this -> db_name = $env["db_name"];
      $this -> db_user = $env["db_user"];
      $this -> db_password = $env["db_password"];
      $this -> db_host = $env["db_host"];

      $this -> admin_name = $env["admin_name"];
      $this -> admin_email = $env["admin_email"];
      $this -> admin_password = $env["admin_password"];
      $this -> admin_state = $env["admin_state"];
   }

   function dbConn() {
      
      $options = [
         PDO::ATTR_ERRMODE,
         PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE,
         PDO::FETCH_ASSOC,
      ];
      
      try {
         $db = new PDO(
            "mysql:dbname=". $this -> db_name .";host=". $this -> db_host,
            $this -> db_user,
            $this -> db_password,
            $options
         );
         
         $db -> exec("SET NAMES utf8");
         return $db;
      }
      
      catch(PDOException $except) {
         die($except -> getMessage());
      }
   }
}


$connectClass = new Connect($env);