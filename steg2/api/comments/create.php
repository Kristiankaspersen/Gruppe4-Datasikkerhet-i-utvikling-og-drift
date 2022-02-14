<?php 

// {
//     "message_id": "1",  
//     "comment_text": "What are you doing? I am a person you know? I have something you don't, did you know that?"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: POST');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php'; 
include '../../models/Comment.php'; 

// instantiate DB and connect. 
$db = new DatabaseConnection(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input")); 

// Instantiate comment post object 
//$db, $messageID, $commentText
$comment = new Comment(
    $db,
    $data->message_id,
    $data->comment_text
); 

// create post
if($comment->create()) {
    echo json_encode( array('message' => 'Comment Created')); 
} else {

    echo json_encode( array('message' => 'Comment Not Created'));
}