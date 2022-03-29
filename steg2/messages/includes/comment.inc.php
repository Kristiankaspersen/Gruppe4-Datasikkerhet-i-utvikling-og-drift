<?php

session_start(); 

if(isset($_POST["submit"])) {

    include "../../config/DatabaseConnection.php";
    include "../controller/CommentController.php"; 
    include "../../models/Comment.php";

    $db = new DatabaseConnection();

    $comment = new Comment(
        $db,
        $_POST["comment_id"],
        $_POST["comment_text"]
    ); 

    $commentController = new CommentController($comment); 

    $commentController->createComment(); 

    header("Location: ../../courses.php"); 

}