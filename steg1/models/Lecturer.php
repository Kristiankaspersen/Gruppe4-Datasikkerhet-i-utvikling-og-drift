<?php

class Lecturer extends User { 
    private $profilePictureAdress; 
    private $courseID; 

    // I have to do it like this to overload the constructor. 
    function __construct() {
        $args = func_get_args(); 
        switch(func_num_args())
        {
            case 0: 
                $this->construct0();
            break; 
            case 1: 
                $this->construct1($args[0]);
            break;
            case 8: 
                $this->construct8($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]); 
            break; 
            default: 
                trigger_error("Incorrect number of arguments for User::__construct",  E_USER_WARNING);
        }
    }

    private function construct0() {}
    
    private function construct1($db) {
        $this->conn = $db; 
    }
        
    private function construct8($username, $firstName, $lastName,  $email, $password, $passwordRepeat, $profilePictureAdress, $courseID)
    {
        parent::__construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat);
        
        $this->profilePictureAdress = $profilePictureAdress; 
        $this->courseID = $courseID; 
        $this->role = 'lecturer'; 
        
    }



    /**
     * Get the value of profilePictureAdress
     */ 
    public function getProfilePictureAdress()
    {
        return $this->profilePictureAdress;
    }

    /**
     * Get the value of courseID
     */ 
    public function getCourseID()
    {
        return $this->courseID;
    }
}