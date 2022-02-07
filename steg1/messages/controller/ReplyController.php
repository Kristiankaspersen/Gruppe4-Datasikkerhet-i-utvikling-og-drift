<?php

class ReplyController  { 
    private $reply; 
   
    public function __construct($reply)
    {
        $this->reply = $reply;      
    }

    public function createReply() { 

        if(!$this->ValidationsForReply()) {
            return false; 
            exit(); 
        }
        
        if($this->reply->create()) {
            header("location: ../student-message.php?error=YourPostHasBeenSubmitted"); 
            echo "Your reply has been submitted"; 
        } else {
            header("location: ../index.php?error=TheMessageDidNotGetCraeted"); 
            echo "Error in posting reply, try again"; 
        }
    }
 
    // All validations for the same data for user being checked. 
    private function ValidationsForReply() {
        if($this->emptyInput() == false) {
            // empty input; 
            header("location: ../index.php?error=emptyinput"); 
            return false;  
        }

        return true; 

    }

    // User input validations for both lecturer and Student: 
    private function emptyInput() {
        $result = null; 
         
        if(empty($this->reply->getMessageID()) || empty($this->reply->getLecturerID()) || empty($this->reply->getReplyText()) ) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }


}