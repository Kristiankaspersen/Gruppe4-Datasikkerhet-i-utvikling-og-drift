<?php 

// ITM30617, 1, 'What are you doing? I am a person you know? I have something you don't, did you know that?
// {
//     "courseID": "ITM30617", 
//     "studentID": "1", 
//     "messageText": "What are you doing? I am a person you know? I have something you don't, did you know that?"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: POST');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php'; 
include '../../models/Message.php'; 

// instantiate DB and connect. 
$database = new DatabaseConnection(); 
$db = $database->connect(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input")); 

// Instantiate comment post object 
// private $courseID; private $courseName; private $pinCode;
$message = new Message(
    $db,
    $data->courseID,
    $data->studentID, 
    $data->messageText
); 

// create post
if($message->create()) {
    echo json_encode( array('message' => 'Message Created')); 
} else {

    echo json_encode( array('message' => 'Message Not Created'));

}