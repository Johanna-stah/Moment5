<?php

Class User {
    private $db;
    public function __construct ($conn) {  
    $this->db = $conn;    
    }
    
    //REGISTER user
    public function registerUser($fullname, $uname, $email, $pass) : bool {  
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (fullname, userName, userEmail, userPasswordHash) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$fullname, $uname, $email, $passHash);
        
        if($stmt->execute()) {
            return true;
        } else {
            return $stmt->error;
        }   
    }
    
    //LOOK for user
    public function loginUser($user, $pass) : bool {
        //search for username and e-mail
        $stmt = $this->db->prepare("SELECT userName, userEmail, userPasswordHash FROM users WHERE userName = ? OR userEmail = ?");
        $stmt->bind_param("ss", $user, $user);
        $stmt->execute();
        $stmt->store_result();
        
        //If info is found get info, else return error
        if ($stmt->num_rows == 1) {            
            $stmt->bind_result($uname, $email, $passHash);
            $result = $stmt->fetch();
            
            //if password matches setup session, else return error
            if (password_verify($pass, $passHash)) {
                $_SESSION['userName'] = $uname;
                $_SESSION['userEmail'] = $email;
                $_SESSION['userLoginStatus'] = 1;
                
                return true;
            } else {
                return 'Fel lösenord!';
            }
        } else {
            return 'Fel användarnamn eller E-mail!';
        }
    }
    
    //CHECK if user is logged in
    public function isLoggedIn() : bool {
        if(isset($_SESSION['userLoginStatus'])) {
            return true;
        } else {
            return false;
        }
    }
    
    //REDIRECT to different page with url
    public function redirect($url) {
        header("Location: $url");
    }
    
    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
}
?>