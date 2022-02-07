<?php 

// testpost, insert this JSON in postman with POST request: 
// Add content-type: application/json in headears. 
// {
//     "username": "testUser2",
//     "firstName": "testfirstname",
//     "lastName": "testlastname",
//     "email": "test@email.com",
//     "password": "test", 
//     "passwordRepeat": "test",
//     "fieldOfStudy": "test studies",
//     "startingYear": "2014"
// }

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
header('Access-Control-Allow_Methods: POST');
header('Access-Control-Allow-Headers: Access-Control_Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/DatabaseConnection.php';
include '../../models/User.php'; 
include '../../models/Student.php'; 

// instantiate DB and connect. 
$database = new DatabaseConnection(); 
$db = $database->connect(); 

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// $username, $firstName, $lastName,  $email, $password, $passwordRepeat, $fieldOfStudy, $startingYear 
$student = new Student(
    $db,  
    $data->username,
    $data->firstName, 
    $data->lastName, 
    $data->email, 
    $data->password,
    $data->passwordRepeat,
    $data->fieldOfStudy,
    $data->startingYear              
); 

// create post
if($student->create()) {
    echo json_encode( array('message' => 'Post Created')); 
} else {

    echo json_encode( array('message' => 'Post Not Created'));
}