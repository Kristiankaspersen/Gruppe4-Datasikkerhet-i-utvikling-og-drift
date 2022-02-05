<?php

class Comment {


    private $conn; 
    private $commentID; //Do a autoincrement from the db here. 
    private $messageID;
    private $commentText;  

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
            case 2: 
                $this->construct2($args[0], $args[1]);
            break;
            case 3: 
                $this->construct3($args[0], $args[1], $args[2]);
            break;
            case 4: 
                $this->construct4($args[0], $args[1], $args[2], $args[3]);
            break;
            default: 
                trigger_error("Incorrect number of arguments for Student::__construct",  E_USER_WARNING);
        }
    }

    private function construct0() {} 
    
    private function construct1($db) {
        $this->conn = $db; 
    }
    private function construct2($db, $commentID) {
        $this->conn = $db; 
        $this->commentID = $commentID; 
    }
    private function construct3($db, $messageID, $commentText) {
        $this->conn = $db; 
        $this->messageID = $messageID;
        $this->commentText = $commentText; 
    }

    private function construct4($db, $commentID, $messageID, $commentText) {
        $this->conn = $db; 
        $this->commentID = $commentID;  
        $this->messageID = $messageID;
        $this->commentText = $commentText; 
    }

    public function read() { 
        $query = "SELECT * FROM comment"; 

        $stmt = $this->conn->prepare($query); 

        $stmt->execute(); 

        return $stmt; 
    }

    public function create() {
        $query = "INSERT INTO comment(message_message_id, comment_text) 
                  VALUES (?,?)  ";
        
        $stmt = $this->conn->prepare($query);

        // Clean data: 
        $this->messageID = htmlspecialchars(strip_tags($this->messageID)); 
        $this->commentText = htmlspecialchars(strip_tags($this->commentText)); 

        // Execute query 
        if($stmt->execute(array($this->messageID, $this->commentText))) {
            return true; 
        }

        // Print error if something goes wrong
        printf("Error: %s. \n", $stmt->error); 

        return false; 

    }

    public function update() { 

    }

    function delete() {

        $query = "DELETE FROM comment WHERE comment_id = :id"; 

        // Prepare statement 
        $stmt = $this->conn->prepare($query); 

        // Clean data
        $this->commentID = htmlspecialchars(strip_tags($this->commentID)); 

        // Bind data
        $stmt->bindParam(':id', $this->commentID);
        
        // Execute query 
        if($stmt->execute()) {
            return true; 
        }

        // Print error if something goes wrong
        printf("Error: %s. \n", $stmt->error); 

        return false; 

        
    }


}