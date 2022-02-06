<?php

session_start(); 

if(isset($_POST["Submit"])) {

    include "../models/Message.php";
    include "../config/DatabaseConnection.php";

    $db = new DatabaseConnection();

    $message = new Message(
        $db,
        $_POST["course_id"],
        $_SESSION["student_id"],
        $_POST["message_text"]
    ); 

    

    if($message->create()) {
        echo "Your post has been submitted"; 
    } else {
        echo "Error in posting message"; 
    }

}