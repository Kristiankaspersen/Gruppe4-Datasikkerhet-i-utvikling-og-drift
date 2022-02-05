<?php 

class Course {

    private $conn; 

    private $courseID; 
    private $courseName; 
    private $pinCode; 
    
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

    private function construct1($db) {
        $this->conn = $db; 
    }

    private function construct0() {} 
    
    private function construct4($db, $courseID, $courseName, $pinCode) {
        $this->conn = $db;
        $this->courseID = $courseID;
        $this->courseName = $courseName;
        $this->pinCode = $pinCode; 
    } 
    
    public function read() { 
        $query = "SELECT * FROM course"; 

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