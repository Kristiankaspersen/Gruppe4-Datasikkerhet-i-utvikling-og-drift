<?php

function setComments() {
    require_once "DatabaseConnection.php";
    if(isset($_POST['commentSubmit'])) {
        $db = new DatabaseConnection();

       $message_message_id = $_POST["message_message_id"];
       $comment_text = $_POST["comment_text"];

        $sql = "INSERT INTO comment (message_message_id, comment_text) VALUES ('$message_message_id', '$comment_text')";
        $result = $db->dbConn->query($sql);
    }

}