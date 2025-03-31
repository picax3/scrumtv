<?php

ob_start();
session_start();

date_default_timezone_set("Pacific/Auckland");

try {
    $con = new PDO("mysql:dbname=scrumtv;host=127.0.0.1", "root", "");
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    // setting an error mode attribute to error mode warning value
}
catch (PDOException $e) { // listening to a variable type of PDO Exception and it will be called e
    exit("Connection failed: " . $e->getMessage()); // dot allows us to append a string to this // if it fails to connect to a database -> exit = stop running any php code
    
}
?>