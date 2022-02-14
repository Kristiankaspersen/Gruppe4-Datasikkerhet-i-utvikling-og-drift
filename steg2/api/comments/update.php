<?php 

// {
//     "comment_id": "1",  
//     "comment_text": "extraordinary updated comment"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: PUT');
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
    $data->comment_id, 
); 

// using setter here, because I could'nt use a construct, with these kinds of arguments. 
$comment->setCommentText($data->comment_text); 

// create post
if($comment->update()) {
    echo json_encode( array('message' => 'Comment Updated')); 
} else {

    echo json_encode( array('message' => 'Comment Not Updated'));
}