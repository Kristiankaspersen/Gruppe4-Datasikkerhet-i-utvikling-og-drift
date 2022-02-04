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
            case 9: 
                $this->construct9($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8]);
            break;
            default: 
                trigger_error("Incorrect number of arguments for Student::__construct",  E_USER_WARNING);
        }
    }

    private function construct0() {}
    
    private function construct1($db) {
        $this->conn = $db; 
    }

    private function construct9($db, $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear)
    {
        parent::__construct($username, $firstName, $lastName, $email, $password, $passwordRepeat); 
        $this->fieldOfStudy = $fieldOfStudy; 
        $this->startingYear = $startingYear; 
        
        $this->conn = $db; 
        $this->role = 'student'; 
        
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

    // Create blog post
    public function create() {

        $insertUserTable = $this->conn->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); ');
        $insertStudentTable = $this->conn->prepare('INSERT INTO student (student_id ,field_of_study, starting_year) VALUES (? ,?, ?); ');
        $insertStudentHasUserTable = $this->conn->prepare('INSERT INTO student_has_user (student_student_id, user_username) VALUES (?, ?)'); 

        $studentID = $this->conn->query('SELECT COUNT(*) FROM student;')->fetchAll(PDO::FETCH_ASSOC);
        
        // Doing it like this, will not work if students are deleted in DB. 
        $studentID = $studentID[0]["COUNT(*)"];
        
        // Checks if student_id exists: 
        $checkIfStudentIdExists = null; 
        do {
            $studentID +=1;
            $checkIfStudentIdExists = $this->conn->query("SELECT student_id FROM student WHERE student_id = $studentID")->fetchAll(PDO::FETCH_ASSOC);
            $checkIfStudentIdExists = $checkIfStudentIdExists[0]["student_id"];

        } while($checkIfStudentIdExists != null); 

        // $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear

        // Clean data
        $this->username = htmlspecialchars(strip_tags($this->username)); 
        $this->firstName = htmlspecialchars(strip_tags($this->firstName)); 
        $this->lastName = htmlspecialchars(strip_tags($this->lastName)); 
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->fieldOfStudy = htmlspecialchars(strip_tags($this->fieldOfStudy));
        $this->startingYear = htmlspecialchars(strip_tags($this->startingYear));
         
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT); 

        // have to do a transaction here or something In case of any of the executions goes wrong. 
        if(!$insertUserTable->execute(array($this->username, $this->firstName, $this->lastName, $this->email, $hashedPassword, $this->role))) {
                printf("Error: %s. \n", $insertUserTable->error);
                $insertUserTable = null; 
                return false; 
        } 
        if(!$insertStudentTable->execute(array($studentID, $this->fieldOfStudy, $this->startingYear))) {
                printf("Error: %s. \n", $insertStudentTable->error);
                $insertStudentTable = null; 
                
                return false;  
        } 
        if(!$insertStudentHasUserTable->execute(array($studentID, $this->username))) {
                printf("Error: %s. \n", $insertStudentHasUserTable->error);
                $insertStudentHasUserTable = null;
                
                return false; 

        }
        

        $insertUserTable = null; 
        $insertStudentTable = null; 
        $insertStudentHasUserTable = null;

        return true; 
    
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
