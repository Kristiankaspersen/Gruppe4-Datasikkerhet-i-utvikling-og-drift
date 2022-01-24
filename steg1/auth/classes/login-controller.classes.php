<?php

class LoginController extends Login { 
    private $usernameOrEmail; 
    private $password; 
  
    public function __construct($usernameOrEmail, $password) {
        $this->usernameOrEmail = $usernameOrEmail; 
        $this->password = $password; 
 
    }

    public function loginUser() {
        if($this->emptyInput() == false) {
            // empty input; 
            header("location: ../index.php?error=emptyinput"); 
            exit(); 
        }
        $this->getUser($this->usernameOrEmail, $this->password); 
    }


    private function emptyInput() {
        $result = null;  
        if(empty($this->usernameOrEmail) || empty($this->password)) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }
}