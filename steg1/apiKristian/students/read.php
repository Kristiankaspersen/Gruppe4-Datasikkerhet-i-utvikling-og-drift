<?php

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');

include '../../config/DatabaseConnection.php'; 
include '../../models/Student.php'; 

$database = new DatabaseConnection(); 
$db = $database->connect();

$student = new Student($db); 

// Student post query 
$result = $post->read(); 

$num = $result->rowCount(); 

// check if any posts 
if ($num > 0) {
    $student_arr = array(); 
    $student_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        // Do this, with student data: 
        $student_item = array(
            'id' => $id, 
            'title' => $title, 
            'body' => html_entity_decode($body),
            'author' => $author, 
            'category_id' => $category_id, 
            'category_name' => $category_name
        );
        // push to "data"  
        array_push($student_arr['data'], $student_item); 

    }



}


