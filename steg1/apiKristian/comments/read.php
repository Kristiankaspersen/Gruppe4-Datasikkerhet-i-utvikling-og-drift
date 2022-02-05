<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php';
include '../../models/Comment.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$comment = new Comment($db); 

//$lecturer post query 
$result = $comment->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $comment_arr = array(); 
    $comment_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with$lecturer data: 
        $comment_item = array(
            'comment_id' => $comment_id,
            'message_message_id' => $message_message_id,
            'comment_text' => $comment_text
        );

        // push to "data"  
        array_push($comment_arr['data'], $comment_item); 

    }

  // Turn to JSON and Output: 
  echo json_encode($course_arr);

}  else {
    echo json_encode(array('message' => 'No comment found')); 
}