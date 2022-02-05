<?php

class Reply {

private $conn; 

private $messageID;
private $lecturerID; 
private $replyText; 

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
        default: 
            trigger_error("Incorrect number of arguments for Student::__construct",  E_USER_WARNING);
    }
}

private function construct0() {}

private function construct1($db) { $this->conn = $db; }   

private function construct4($db, $messageID, $lecturerID, $replyText) {
    $this->conn = $db; 
    $this->messageID = $messageID; 
    $this->lecturerID = $lecturerID; 
    $this->replyText = $replyText; 

} 

public function read() { 
    $query = "SELECT * FROM reply"; 

    $stmt = $this->conn->prepare($query); 

    $stmt->execute(); 

    return $stmt; 

}

public function create() {
    $query = "INSERT INTO reply(message_message_id, lecturer_lecturer_id, reply_text) 
              VALUES (?, ?, ?)  ";
    
    $stmt = $this->conn->prepare($query);

    // Clean data: 
    $this->messageID = htmlspecialchars(strip_tags($this->messageID)); 
    $this->lecturerID = htmlspecialchars(strip_tags($this->lecturerID)); 
    $this->replyText = htmlspecialchars(strip_tags($this->replyText)); 

    // Execute query 
    if($stmt->execute(array($this->messageID, $this->lecturerID, $this->replyText))) {
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


}