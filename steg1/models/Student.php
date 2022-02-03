<?php

class Student extends User { 
    private $fieldOfStudy; 
    private $startingYear; 
 

    function __construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear)
    {
        parent::__construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat);
        $this->fieldOfStudy = $fieldOfStudy; 
        $this->startingYear = $startingYear; 

        $this->role = 'student'; 
        
    }

    // getters: 
    public function getFieldOfStudy()
    {
        return $this->fieldOfStudy;
    }
 
    public function getStartingYear()
    {
        return $this->startingYear;
    }

}
