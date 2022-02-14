<?php

session_start(); 

if(isset($_POST["submit"])) {

    include "../../config/DatabaseConnection.php";
    include "../../models/Reply.php";
    include "../controller/ReplyController.php"; 

    $db = new DatabaseConnection();

    $reply = new Reply(
        $db,
        $_POST["message_id"],
        $_SESSION["lecturer_id"],
        $_POST["reply_text"]
    ); 

    $replyController = new ReplyController($reply); 
   
    $replyController->createReply();    

}