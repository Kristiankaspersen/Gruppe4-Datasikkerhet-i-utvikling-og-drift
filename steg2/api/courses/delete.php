<?php 

//
// {
//     "course_id": "ITM30618",
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php'; 
include '../../models/Course.php'; 

// instantiate DB and connect. 
$db = new DatabaseConnection(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input")); 

// Instantiate comment post object 
// private $courseID; private $courseName; private $pinCode;
$course = new Course(
    $db,
    $data->course_id,
); 

// create post
if($course->delete()) {
    echo json_encode( array('message' => 'Course deleted')); 
} else {

    echo json_encode( array('message' => 'Course Not deleted'));

}