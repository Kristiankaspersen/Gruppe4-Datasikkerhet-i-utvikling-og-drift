<?php

class Reply  { 
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
        
        $this->reply->create(); 
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