<?php

class Lecturer extends User { 
    private $profilePictureAdress; 
    private $courseID;
    private $lecturerID;  

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
            case 3: 
                $this->construct3($args[0], $args[1], $args[2]);
            break;
            case 8: 
                $this->construct8($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]); 
            break; 
            case 9: 
                $this->construct9($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8]);
            break;
            case 10: 
                $this->construct10($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8], $args[9]);
            break;
            default: 
                trigger_error("Incorrect number of arguments for Lecturer::__construct",  E_USER_WARNING);
        }
    }

    private function construct0() {}
    
    private function construct1($db) {
        $this->conn = $db; 
    }

    private function construct3($db, $username, $lecturerID) {
        parent::__construct($username);
        $this->conn = $db;
        $this->lecturerID = $lecturerID;  
    }
        
    private function construct8($username, $firstName, $lastName,  $email, $password, $passwordRepeat, $profilePictureAdress, $courseID)
    {
        parent::__construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat);
        
        $this->profilePictureAdress = $profilePictureAdress; 
        $this->courseID = $courseID; 
        $this->role = 'lecturer'; 
        
    }

    private function construct9($db, $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $profilePictureAdress, $courseID)
    {
        parent::__construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat);
        
        $this->profilePictureAdress = $profilePictureAdress; 
        $this->courseID = $courseID; 

        $this->conn = $db; 
        $this->role = 'lecturer'; 
        
    }

    private function construct10($db, $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $profilePictureAdress, $courseID, $lecturerID)
    {
        parent::__construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat);
        
        $this->profilePictureAdress = $profilePictureAdress; 
        $this->courseID = $courseID;
        $this->lecturerID = $lecturerID;  

        $this->conn = $db; 
        $this->role = 'lecturer'; 
        
    }

    public function read() {
        // create query 
        $query = "SELECT  *
                    FROM VWlecturer
                    ORDER BY lecturer_id DESC"; 
        // Prepare statment 
        $stmt = $this->conn->prepare($query); 

        $stmt->execute(); 
        
        return $stmt; 
    }

    // Create lecturer 
    public function create() {

        $insertUserTable = $this->conn->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); ');
        $insertLecturerTable = $this->conn->prepare('INSERT INTO lecturer (lecturer_id, profilepicture, course_course_id) VALUES (? ,?, ?); ');
        $insertLecturerHasUserTable = $this->conn->prepare('INSERT INTO lecturer_has_user (lecturer_lecturer_id, user_username) VALUES (?, ?)'); 

        $lecturerID = $this->conn->query('SELECT COUNT(*) FROM student;')->fetchAll(PDO::FETCH_ASSOC);
        
        // Doing it like this, will not work if students are deleted in DB. 
        $lecturerID = $lecturerID[0]["COUNT(*)"];
        
        // Checks if student_id exists: 
        $checkIfLecturerIdExists = null; 
        do {
            $lecturerID +=1;
            $checkIfLecturerIdExists = $this->conn->query("SELECT student_id FROM student WHERE student_id = $lecturerID")->fetchAll(PDO::FETCH_ASSOC);
            $checkIfLecturerIdExists = $checkIfLecturerIdExists[0]["student_id"];

        } while($checkIfLecturerIdExists != null); 

        // $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear

        // Clean data
        $this->username = htmlspecialchars(strip_tags($this->username)); 
        $this->firstName = htmlspecialchars(strip_tags($this->firstName)); 
        $this->lastName = htmlspecialchars(strip_tags($this->lastName)); 
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->profilePictureAdress = htmlspecialchars(strip_tags($this->profilePictureAdress));
        $this->courseID = htmlspecialchars(strip_tags($this->courseID));
         
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT); 

        // have to do a transaction here or something In case of any of the executions goes wrong. 
        if(!$insertUserTable->execute(array($this->username, $this->firstName, $this->lastName, $this->email, $hashedPassword, $this->role))) {
                printf("Error: %s. \n", $insertUserTable->error);
                $insertUserTable = null; 
                return false; 
        } 
        if(!$insertLecturerTable->execute(array($lecturerID, $this->profilePictureAdress, $this->courseID))) {
                printf("Error: %s. \n", $insertLecturerTable->error);
                $insertLecturerTable = null; 
                
                return false;  
        } 
        if(!$insertLecturerHasUserTable->execute(array($lecturerID, $this->username))) {
                printf("Error: %s. \n", $insertLecturerHasUserTable->error);
                $insertLecturerHasUserTable = null;
                
                return false; 
        }
        

        $insertUserTable = null; 
        $insertLecturerTable = null; 
        $insertLecturerHasUserTable = null;

        return true; 
    
    }

    // Create lecturer 
    public function update() {

        $insertUserTable = $this->conn->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); ');
        $insertLecturerTable = $this->conn->prepare('INSERT INTO lecturer (lecturer_id, profilepicture, course_course_id) VALUES (? ,?, ?); ');
        $insertLecturerHasUserTable = $this->conn->prepare('INSERT INTO lecturer_has_user (lecturer_lecturer_id, user_username) VALUES (?, ?)'); 


        // $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear

        // Clean data
        $this->username = htmlspecialchars(strip_tags($this->username)); 
        $this->firstName = htmlspecialchars(strip_tags($this->firstName)); 
        $this->lastName = htmlspecialchars(strip_tags($this->lastName)); 
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->profilePictureAdress = htmlspecialchars(strip_tags($this->profilePictureAdress));
        $this->courseID = htmlspecialchars(strip_tags($this->courseID));
        $this->lecturerID = htmlspecialchars(strip_tags($this->lecturerID));
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT); 

        // have to do a transaction here or something In case of any of the executions goes wrong. 
        if(!$insertUserTable->execute(array($this->username, $this->firstName, $this->lastName, $this->email, $hashedPassword, $this->role))) {
                printf("Error: %s. \n", $insertUserTable->error);
                $insertUserTable = null; 
                return false; 
        } 
        if(!$insertLecturerTable->execute(array($this->lecturerID, $this->profilePictureAdress, $this->courseID))) {
                printf("Error: %s. \n", $insertLecturerTable->error);
                $insertLecturerTable = null; 
                
                return false;  
        } 
        if(!$insertLecturerHasUserTable->execute(array($this->lecturerID, $this->username))) {
                printf("Error: %s. \n", $insertLecturerHasUserTable->error);
                $insertLecturerHasUserTable = null;
                
                return false; 
        }
        

        $insertUserTable = null; 
        $insertLecturerTable = null; 
        $insertLecturerHasUserTable = null;

        return true; 
    
    }

    // delete lecturer 
    public function delete() {

        $insertLecturerHasUserTable = $this->conn->prepare('DELETE FROM lecturer_has_user WHERE lecturer_lecturer_id = :lecturer_id AND user_username = :username');
        $insertLecturerTable = $this->conn->prepare('DELETE FROM lecturer  WHERE lecturer_id = :lecturer_id');
        $insertUserTable = $this->conn->prepare('DELETE FROM user WHERE username = :username');

        // Clean data
        $this->username = htmlspecialchars(strip_tags($this->username)); 
        $this->lecturerID = htmlspecialchars(strip_tags($this->lecturerID));

            // Bind data
        $insertLecturerTable->bindParam(':lecturer_id', $this->lecturerID);
        $insertLecturerHasUserTable->bindParam(':lecturer_id', $this->lecturerID);
        $insertLecturerHasUserTable->bindParam(':username', $this->username);
        $insertUserTable->bindParam(':username', $this->username);

        if(!$insertLecturerHasUserTable->execute()) {
            printf("Error: %s. \n", $insertLecturerHasUserTable->error);
            $insertLecturerHasUserTable = null;
            
            return false; 
        }
        if(!$insertLecturerTable->execute()) {
            printf("Error: %s. \n", $insertLecturerTable->error);
            $insertLecturerTable = null; 
            
            return false;  
    } 
        if(!$insertUserTable->execute()) {
                printf("Error: %s. \n", $insertUserTable->error);
                $insertUserTable = null; 
                return false; 
        } 
        
        $insertUserTable = null; 
        $insertLecturerTable = null; 
        $insertLecturerHasUserTable = null;

        return true;
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