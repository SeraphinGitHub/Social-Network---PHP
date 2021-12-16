<?php

@require_once "env.php";

try {
   $db = new PDO("mysql:dbname=$DB_NAME;host=$DB_HOST", $DB_USER, $DB_PSW);
   $db -> exec("SET NAMES utf8"); // <== Send Data as UTF8 (for none ASCII chars)

   $db -> setAttribute(
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE,
      PDO::FETCH_ASSOC
   );   
}

catch(PDOException $except) {
   die($except -> getMessage());
}