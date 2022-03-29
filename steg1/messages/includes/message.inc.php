<?php

session_start(); 

if(isset($_POST["submit"])) {

    include "../../config/DatabaseConnection.php";
    include "../../models/Message.php";
    include "../controller/MessageController.php"; 

    $db = new DatabaseConnection();

    $message = new Message(
        $db,
        $_POST["course_id"],
        $_SESSION["student_id"],
        $_POST["message_text"]
    ); 

    $messageController = new MessageController($message); 

    $messageController->createMessage(); 
  

} else {
    echo "the message is not going through "; 
}