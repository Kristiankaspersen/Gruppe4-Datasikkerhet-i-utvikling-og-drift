<?php

class Reply {

private $conn; 

private $messageID;
private $lecturerID; 
private $reply_text; 

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

private function construct4($db, $messageID, $lecturerID, $reply_text) {
    $this->conn = $db; 
    $this->messageID = $messageID; 
    $this->lecturerID = $lecturerID; 
    $this->$reply_text = $reply_text; 

} 

public function read() { 
    $query = "SELECT * FROM reply"; 

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