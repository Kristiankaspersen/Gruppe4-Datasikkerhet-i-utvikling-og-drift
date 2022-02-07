<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php';
include '../../models/Message.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$message = new Message($db); 

//$read query 
$result = $message->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $message_arr = array(); 
    $message_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with$lecturer data: 
        $message_item = array(
            'message_id' => $message_id,
            'course_course_id' => $course_course_id,
            'student_student_id' => $student_student_id,
            'message_text' => $message_text
        );

        // push to "data"  
        array_push($message_arr['data'], $message_item); 

    }

  // Turn to JSON and Output: 
  echo json_encode($message_arr);

}  else {
    echo json_encode(array('message' => 'No message found')); 
}