<?php

session_start(); 

if(isset($_POST["Submit"])) {

    include "../../config/DatabaseConnection.php";
    include "../controller/CommentController.php"; 
    include "../../models/Comment.php";

    $db = new DatabaseConnection();

    $comment = new Comment(
        $db,
        $_POST["message_id"],
        $_POST["message_text"]
    ); 

    $messageController = new CommentController($comment); 

    if($messageController->createComment()) {
        echo "Your post has been submitted"; 
    } else {
        echo "Error in posting comment"; 
    }

}