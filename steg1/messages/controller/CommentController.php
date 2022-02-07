<?php

class CommentController { 
    private $comment; 
   
    public function __construct($comment)
    {
        $this->comment = $comment;      
    }

    public function createComment() { 

        if(!$this->ValidationsForComments()) {
            return false; 
            exit(); 
        }
        
        $this->comment->create(); 
    }
 
    // All validations for the same data for user being checked. 
    private function ValidationsForComments() {
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
         
        if(empty($this->comment->getMessageID()) || empty($this->comment->getCommentText()) ) {
            $result = false; 
        }
        else {
            $result = true; 
        }
        return $result; 
    }


}