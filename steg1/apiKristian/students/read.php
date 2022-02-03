<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php';
include '../../models/User.php'; 
include '../../models/Student.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$student = new Student($db); 

// Student post query 
$result = $student->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $student_arr = array(); 
    $student_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with student data: 
        $student_item = array(
            'username' => $username, 
            'first_name' => $first_name, 
            'last_name' => $last_name,
            'email' => $email, 
            'password' => $password, 
            'user_role' => $user_role,
            'student_id' => $student_id,
            'field_of_study' => $field_of_study,
            'starting_year' => $starting_year
        );
        // push to "data"  
        array_push($student_arr['data'], $student_item); 

    }

  // Turn to JSON and Output: 
  echo json_encode($student_arr);

}  else {
    echo json_encode(array('message' => 'No students found')); 
}





