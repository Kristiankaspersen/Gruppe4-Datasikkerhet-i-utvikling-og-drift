<?php

class MessageController { 
    private $message; 
   
    public function __construct($message)
    {
        $this->message = $message;      
    }

    public function createMessage() { 

        if(!$this->ValidationsForMessage()) {
            return false; 
            exit(); 
        }
        
        if($this->message->create()) {
            header("location: ../student-message.php?error=YourPostHasBeenSubmitted"); 
            echo "Your post has been submitted"; 
        } else {
            header("location: ../index.php?error=TheMessageDidNotGetCraeted"); 
            echo "Error in posting message, try again"; 
        }
    }
 
    // All validations for the same data for user being checked. 
    private function ValidationsForMessage() {
        if($this->emptyInput() == false) {
            // empty input; 
            header("location: /student-message.php?error=emptyinput"); 
            return false;  
        }

        return true; 

    }

    // User input validations for both lecturer and Student: 
    private function emptyInput() {
        $result = null; 
         
        if(empty($this->message->getCourseID()) || empty($this->message->getStudentID()) || empty($this->message->getMessageText()) ) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }


}