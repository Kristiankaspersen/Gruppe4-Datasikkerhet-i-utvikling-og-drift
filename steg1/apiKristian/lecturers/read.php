<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php';
include '../../models/User.php'; 
include '../../models/Lecturer.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$lecturer = new Lecturer($db); 

//$lecturer post query 
$result = $lecturer->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $lecturer_arr = array(); 
    $lecturer_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with$lecturer data: 
        $lecturer_item = array(
            'username' => $username, 
            'first_name' => $first_name, 
            'last_name' => $last_name,
            'email' => $email, 
            'password' => $password, 
            'user_role' => $user_role,
            'lecturer_id' => $lecturer_id,
            'profilepicture' => $profilepicture,
            'course_course_id' => $course_course_id
        );
        // push to "data"  
        array_push($lecturer_arr['data'], $lecturer_item); 

    }

  // Turn to JSON and Output: 
  echo json_encode($lecturer_arr);

}  else {
    echo json_encode(array('message' => 'No Lecturers found')); 
}