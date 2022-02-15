<?php

class SignupController extends Signup { 
    private $user; 
   
    public function __construct($user)
    {
        $this->user = $user;      
    }

    public function signupStudent() { 

        if(!$this->checkingSameValidationsForUser()) {
            return false; 
            exit(); 
        }
        if(!$this->emptyInputStudent()) {
            header("location: ../index.php?error=emptyinput"); 
            return false;
            exit(); 
        }
        // Arguemnts: username, firstName, lastName,  email, password, userRole, fieldOfStudy, startingYear
        $this->setStudent($this->user->getUsername(), $this->user->getfirstName(), $this->user->getLastName(), $this->user->getEmail(), 
                            $this->user->getPassword(), $this->user->getRole(), $this->user->getFieldOfStudy(), $this->user->getStartingYear()); 
    }

    public function signupLecturer() { 

        if(!$this->checkingSameValidationsForUser()) {
            exit(); 
        }
        if(!$this->emptyInputLecturer()) {
            header("location: ../index.php?error=emptyinput"); 
            return false;
            exit(); 
        }
        // Arguemnts: username, firstName, lastName,  email, password, userRole, profilePictureAdress 
        $this->setLecturer($this->user->getUsername(), $this->user->getfirstName(), $this->user->getLastName(), $this->user->getEmail(), 
        $this->user->getPassword(), $this->user->getRole(), $this->user->getProfilePictureAdress(), $this->user->getCourseId());
    }

    //Checking individual validations for Student: 
    private function emptyInputStudent() { 
        $result = null; 
         
        if(empty($this->user->getFieldOfStudy()) || empty($this->user->getStartingYear())) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 

    }

    // Checking indivudual validationds for Lecturer: 
    private function emptyInputLecturer() { 
        $result = null; 
         
        if(empty($this->user->getCourseId()) || empty($this->user->getProfilePictureAdress())) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 

    }

    // Make method that chekcs if the course exists in the db. 

    // All validations for the same data for user being checked. 
    private function checkingSameValidationsForUser() {
        if($this->emptyInput() == false) {
            // empty input; 
            header("location: ../index.php?error=emptyinput"); 
            return false;  
        }
        if($this->invalidUsername() == false) {
            // Invalid username; 
            header("location: ../index.php?error=username"); 
            return false; 
        }
        if($this->invalidEmail() == false) {
            // Invalid Email; 
            header("location: ../index.php?error=email"); 
            return false;  
        }
        if($this->passwordMatch() == false) {
            // Wrong password; 
            header("location: ../index.php?error=passwordMatch"); 
            return false; 
        }
        if($this->usernameTakenCheck() == false) {
            // Username taken; 
            header("location: ../index.php?error=userOrEmailTaken"); 
            return false;  
        }

        return true; 

    }

    // User input validations for both lecturer and Student: 
    private function emptyInput() {
        $result = null; 
         
        if(empty($this->user->getUsername()) || empty($this->user->getPassword()) || empty($this->user->getPasswordRepeat())
         || empty($this->user->getEmail()) || empty($this->user->getFirstName()) || empty($this->user->getLastName())) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }

    private function invalidUsername() {
        $result = null; 
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->user->getUsername())) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }

    private function invalidEmail() {
        $result = null; 
        if(!filter_var($this->user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }

    private function passwordMatch() { 
        $result = null; 
        if($this->user->getPassword() !== $this->user->getPasswordRepeat()) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result;

    }

    private function usernameTakenCheck() { 
        $result = null;  
        if(!$this->checkUser($this->user->getUsername(), $this->user->getEmail())) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result;

    }


}