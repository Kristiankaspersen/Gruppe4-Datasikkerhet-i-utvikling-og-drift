<?php 

class Message {

    private $messageID;
    private $courseID; 
    private $studentID; 
    private $message_text; 

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
                $this->construct5($args[0], $args[1], $args[2], $args[3], $args[4]);
            break; 
            default: 
                trigger_error("Incorrect number of arguments for Student::__construct",  E_USER_WARNING);
        }
    }

    private function construct1($db) {
        $this->conn = $db; 
    }

    private function construct0() {} 
    
    private function construct5($db, $messageID,  $courseID, $studentID, $message_text) {
        $this->conn = $db;
        $this->messageID = $messageID; 
        $this->courseID = $courseID;
        $this->studentID = $studentID; 
        $this->message_text = $message_text; 
    
    } 
    
    public function read() { 
        $query = "SELECT * FROM message"; 

        // prepare
        $stmt = $this->conn->prepare($query); 

        $stmt->execute(); 

        return $stmt; 
    }

    public function create() {

    }

    public function update() { 

    }

    public function delete() { 

    }


}