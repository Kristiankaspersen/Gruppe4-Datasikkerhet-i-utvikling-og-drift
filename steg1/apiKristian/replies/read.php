<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php';
include '../../models/Reply.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$reply = new Reply($db); 

//reply query 
$result = $reply->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $reply_arr = array(); 
    $reply_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with$lecturer data: 
        $course_item = array(
            'message_message_id' => $message_message_id,
            'lecturer_lecturer_id' => $lecturer_lecturer_id,
            'reply_text' => $reply_text

        );

        // push to "data"  
        array_push($reply_arr['data'], $reply_item); 
    }

  // Turn to JSON and Output: 
  echo json_encode($reply_arr);

}  else {
    echo json_encode(array('message' => 'No reply found')); 
}