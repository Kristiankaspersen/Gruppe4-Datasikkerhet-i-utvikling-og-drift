<?php

class Student extends User { 
    private $conn; 

    private $fieldOfStudy; 
    private $startingYear; 

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
    

    private function construct8($username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear)
    {
        parent::__construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat);
        $this->fieldOfStudy = $fieldOfStudy; 
        $this->startingYear = $startingYear; 

        $this->role = 'student'; 
        
    }


    public function read() {
        // create query 
        $query = "SELECT  *
                    FROM VWstudents
                    ORDER BY student_id DESC"; 
        // Prepare statment 
        $stmt = $this->conn->prepare($query); 

        $stmt->execute(); 
        
        return $stmt; 
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
