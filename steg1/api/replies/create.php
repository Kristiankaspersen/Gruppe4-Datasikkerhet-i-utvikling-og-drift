<?php 

// JSON send with post request. 

// {
//     "messageID": "1",
//     "lecturerID": "1",
//     "replyText": "noob"
// }


header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: POST');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php'; 
include '../../models/Reply.php'; 

// instantiate DB and connect. 
$db = new DatabaseConnection(); 


// Get raw posted data
$data = json_decode(file_get_contents("php://input")); 

// Instantiate reply object 
$reply = new Reply(
    $db,
    $data->messageID,
    $data->lecturerID, 
    $data->replyText
); 

// create reply
if($reply->create()) {
    echo json_encode( array('message' => 'Reply Created')); 
} else {

    echo json_encode( array('message' => 'Reply Not Created'));

}