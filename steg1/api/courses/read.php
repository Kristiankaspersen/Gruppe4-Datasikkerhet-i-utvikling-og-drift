<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php';
include '../../models/Course.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$course = new Course($db); 

//$lecturer post query 
$result = $course->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $course_arr = array(); 
    $course_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with$lecturer data: 
        $course_item = array(
            'course_id' => $course_id,
            'course_name' => $course_name,
            'pin_code' => $pin_code

        );

        // push to "data"  
        array_push($course_arr['data'], $course_item); 

    }

  // Turn to JSON and Output: 
  echo json_encode($course_arr);

}  else {
    echo json_encode(array('message' => 'No course found')); 
}