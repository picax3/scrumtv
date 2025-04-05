<?php
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/Entity.php");

if(!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}
    $userLoggedIn = $_SESSION["userLoggedIn"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to ScrumTV</title>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            
            <script src="https://kit.fontawesome.com/a86e6550cd.js" crossorigin="anonymous"></script>
            <script src="assets/js/script.js"></script>
            <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>
    <body>
        <div class='wrapper'>

