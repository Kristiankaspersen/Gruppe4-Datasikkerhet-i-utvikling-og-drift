<?php 

// testpost, insert this JSON in postman with PUT request: 
// Add content-type: application/json in headears. 
// {
//     "username": "testUser3",
//     "first_name": "testfirstname",
//     "last_name": "testlastname",
//     "email": "testLecturer4@email.com",
//     "password": "test", 
//     "lecturer_id": "1",
//     "profilepicture": "testpic.png",
//     "course_id": "ITM30617"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php';
include '../../models/User.php'; 
include '../../models/Lecturer.php'; 

// instantiate DB and connect. 
$database = new DatabaseConnection(); 
$db = $database->connect(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// $db, $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $profilePictureAdress, $courseID
$lecturer = new Lecturer(
    $db,  
    $data->username,
    $data->first_name, 
    $data->last_name, 
    $data->email, 
    $data->password,
    $passwordRepeat = "not needed",
    $data->lecturer_id, 
    $data->profilepicture,
    $data->course_id              
); 

// create post
if($lecturer->update()) {
    echo json_encode( array('message' => 'Lecturer updated')); 
} else {

    echo json_encode( array('message' => 'Lecturer updated'));
}