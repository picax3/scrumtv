<?php

ob_start();
session_start();

date_default_timezone_set("Pacific/Auckland");

try {
    //$con = new PDO("mysql:dbname=scrumtv;host=127.0.0.1", "root", "");
    $con = new PDO("mysql:dbname=scrumtv;host=db", "root", "example");
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>