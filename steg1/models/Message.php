<?php 

class Message {

    private $conn; 
    private $messageID;
    private $courseID; 
    private $studentID; 
    private $messageText; 

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
            case 4: 
                $this->construct4($args[0], $args[1], $args[2], $args[3]);
            break; 
            case 5: 
                $this->construct5($args[0], $args[1], $args[2], $args[3], $args[4]);
            break; 
            default: 
                trigger_error("Incorrect number of arguments for Message::__construct",  E_USER_WARNING);
        }
    }

    

    private function construct0() {} 

    private function construct1($db) {
        $this->conn = $db; 
    }

    private function construct4($db, $courseID, $studentID, $messageText) {
        $this->conn = $db;
        $this->courseID = $courseID;
        $this->studentID = $studentID; 
        $this->messageText = $messageText; 
    
    } 
    
    private function construct5($db, $messageID,  $courseID, $studentID, $messageText) {
        $this->conn = $db;
        $this->messageID = $messageID; 
        $this->courseID = $courseID;
        $this->studentID = $studentID; 
        $this->messageText = $messageText; 
    
    } 
    
    public function read() { 
        $query = "SELECT * FROM message"; 

        // prepare
        $stmt = $this->conn->prepare($query); 

        $stmt->execute(); 

        return $stmt; 
    }

    public function create() {
        $query = "INSERT INTO message(course_course_id, student_student_id, message_text) 
                  VALUES (?,?,?)  ";
        
        $stmt = $this->conn->connect()->prepare($query);

        // Clean data: 
        $this->courseID = htmlspecialchars(strip_tags($this->courseID)); 
        $this->studentID = htmlspecialchars(strip_tags($this->studentID)); 
        $this->messageText = htmlspecialchars(strip_tags($this->messageText)); 

        // Execute query 
        if($stmt->execute(array($this->courseID, $this->studentID, $this->messageText))) {
            return true; 
        }

        // Print error if something goes wrong
        printf("Error: %s. \n", $stmt->error); 

        return false; 

    }

    public function update() { 

    }

    public function delete() { 

    }



    /**
     * Get the value of courseID
     */ 
    public function getCourseID()
    {
        return $this->courseID;
    }

    /**
     * Get the value of messageID
     */ 
    public function getMessageID()
    {
        return $this->messageID;
    }

    /**
     * Get the value of studentID
     */ 
    public function getStudentID()
    {
        return $this->studentID;
    }

    /**
     * Get the value of messageText
     */ 
    public function getMessageText()
    {
        return $this->messageText;
    }
}