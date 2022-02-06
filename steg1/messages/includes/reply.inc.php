<?php

session_start(); 

if(isset($_POST["Submit"])) {

    include "../../config/DatabaseConnection.php";
    include "../controller/ReplyController.php"; 
    include "../../models/Reply.php";

    $db = new DatabaseConnection();

    $reply = new Reply(
        $db,
        $_POST["message_id"],
        $_SESSION["lecturer_id"],
        $_POST["reply_text"]
    ); 

    $replyController = new ReplyController($reply); 
   
    if($replyController->createMessage()) {
        echo "Your reply has been submitted"; 
    } else {
        echo "Error in posting reply"; 
    }

}