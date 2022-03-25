<?php

Class Validate {
    private $db;
    public function __construct($conn) { 
    $this->db = $conn;
        
    }
    //Returns validated fullname
    public function fullnameValidate($fullname) {
        if(empty($fullname)) {
            return 'Namn är tom!';
        } elseif (strlen($fullname) < 2) {
            return'Namn är för kort!';
        } elseif (strlen($fullname) > 64) {
            return 'Namn är för långt!';
        } elseif (!preg_match('/^[a-ö\d_, .-]{2,64}$/i', $fullname)) {
            return 'Kan ej innehålla specialkaraktärer!';
        } 
    }
    //RETURN validation or error
    public function usernameValidate($uname) {
        if(empty($uname)) {
            return 'Användarnamn är tom!';
        } elseif (strlen($uname) < 2) {
            return'Användarnamn är för kort!';
        } elseif (strlen($uname) > 64) {
            return 'Användarnamn är för långt!';
        } elseif (!preg_match('/^[a-ö\d_, .-]{2,64}$/i', $uname)) {
            return 'Kan ej innehålla specialkaraktärer!';
        } else {
            $uname = strip_tags($uname);
            
            //QUERY for duplicate
            $stmt = $this->db->prepare("SELECT userName FROM users WHERE userName = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt->store_result();
            
            //If duplicate username error, else return username
            if ($stmt->num_rows !== 0) {
                return 'Användarnamn finns redan!';        
            }
        }
    }
    
    //Returns validated email or throws an error
    public function emailValidate($email) {
        if(empty($email)) {
            return 'E-mail är tom!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email';
        } elseif(strlen($email) > 64) {
            return 'E-mail är för långt!';
        } else {
            $email = strip_tags($email);
            
            //Query database for duplicate email
            $stmt = $this->db->prepare("SELECT userEmail FROM users WHERE userEmail = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            //If duplicate email, throw error, else return email
            if ($stmt->num_rows != 0) {
                return 'E-mail finns redan!';        
            }  
        }
    }
    
    //Returns validated password or no match
    public function passwordValidate($pass, $pass2) {
        if (empty($pass) || empty($pass2)) {
            return 'Lösenord är tomt!';
        } elseif (strlen($pass) < 5) {
            return 'Lösenord är för kort!';
        } elseif ($pass !== $pass2) {
            return 'Lösenord matchar ej!';
        }
    }
}
?>