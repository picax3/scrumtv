<?php
class Account {

    private $con;
    private $errorArray = array(); // create empty array in php

    public function __construct($con) {
        $this->con = $con;
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if(empty($this->errorArray)) { // function empty() checks arrays
            return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
        }

        return false;
    }

    private function insertUserDetails($fn, $ln, $un, $em, $pw) { // dont need $em2 nor $pw2

        $pw = hash("sha512", $pw);

        $query=$this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                    VALUES (:fn, :ln, :un, :em, :pw)"); // placeholders
        // bind values to our placeholders
        $query->bindValue(":fn", $fn);                            
        $query->bindValue(":ln", $ln);                            
        $query->bindValue(":un", $un);                            
        $query->bindValue(":em", $em);                            
        $query->bindValue(":pw", $pw);                            
        // execute
        return $query->execute();
    }

    private function validateFirstName($fn) { // private to call it inside the class only
        if(strlen($fn) < 2 || strlen($fn) > 25) { // check length of string
            array_push($this->errorArray, Constants::$firstNameCharacters); // accessing this instance of a class
            // output this string if exist in array
        }

    }
    private function validateLastName($ln) {
        if(strlen($ln) < 2 || strlen($ln) > 25) { // check length of string
            array_push($this->errorArray, Constants::$lastNameCharacters); // accessing this instance of a class
            // output this string if exist in array
        }

    }
    private function validateUsername($un) {
        if(strlen($un) < 3 || strlen($un) > 25) { // check length of string
            array_push($this->errorArray, Constants::$usernameCharacters); // accessing this instance of a class
            return; 
            // output this string if exist in array
        }
 // prepare a query and bind a parameter. protect from sql injection
        $query = $this->con->prepare("SELECT * FROM users WHERE un=:un");
        $query->bindValue(":un", $un);
        $query->execute();

        if($query->rowCount() !=0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }
    
    private function validateEmails($em, $em2) {
        if($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) { // performs a filter on a value
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);
        $query->execute();

        if($query->rowCount() !=0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }  
    }

    private function validatePasswords($pw, $pw2) {
        if($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if(strlen($pw) < 8 || strlen($pw) > 25) { // check length of string
            array_push($this->errorArray, Constants::$passwordLength);
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}
?>