<?php

// ===================================================================
// Scripts PHP
// ===================================================================
require "env.php";
require_once "initDB.php";


// ===================================================================
// Code
// ===================================================================
$options = [
   PDO::ATTR_ERRMODE,
   PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE,
   PDO::FETCH_ASSOC,
];

try {
   $db = new PDO("mysql:dbname=$DB_NAME;host=$DB_HOST", $DB_USER, $DB_PSW, $options);
   $db -> exec("SET NAMES utf8");
}

catch(PDOException $except) {
   die($except -> getMessage());
}


// ===================================================================
// Init DataBase
// ===================================================================
initDataBase($db);