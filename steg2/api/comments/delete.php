<?php 


// {
//     "comment_id": "1", 
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php';
include '../../models/User.php'; 
include '../../models/Comment.php'; 

// instantiate DB and connect. 
$db = new DatabaseConnection(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$comment = new Comment(
    $db,
    $data->comment_id,
); 

// delete student
if($comment->delete()) {
    echo json_encode( array('message' => 'Comment deleted')); 
} else {

    echo json_encode( array('message' => 'Comment not deleted'));
}