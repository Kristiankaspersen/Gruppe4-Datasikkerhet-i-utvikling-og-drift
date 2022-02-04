<?php 


// {
//     "username": "testLecturer2", 
//     "lecturer_id": "8"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php';
include '../../models/User.php'; 
include '../../models/Lecturer.php'; 

// instantiate DB and connect. 
$database = new DatabaseConnection(); 
$db = $database->connect(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$lecturer = new Lecturer(
    $db,
    $data->username,
    $data->lecturerID
); 

// delete lecturer
if($lecturer->delete()) {
    echo json_encode( array('message' => 'Post deleted')); 
} else {

    echo json_encode( array('message' => 'Post not deleted'));
}

