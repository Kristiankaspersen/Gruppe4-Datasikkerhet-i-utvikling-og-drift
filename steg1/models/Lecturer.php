<?php

class Lecturer extends User { 
    private $profilePictureAdress; 
    private $courseID; 


    function __construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat, $profilePictureAdress, $courseID)
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