<?php 

//
// {
//     "course_id": "ITM30618",
//     "course_name": "new course",
//     "pin_code": "4321"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php'; 
include '../../models/Course.php'; 

// instantiate DB and connect. 
$database = new DatabaseConnection(); 
$db = $database->connect(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input")); 

// Instantiate comment post object 
// private $courseID; private $courseName; private $pinCode;
$course = new Course(
    $db,
    $data->course_id,
    $data->course_name, 
    $data->pin_code
); 

// create post
if($course->update()) {
    echo json_encode( array('message' => 'Course updated')); 
} else {

    echo json_encode( array('message' => 'Course Not updated'));

}