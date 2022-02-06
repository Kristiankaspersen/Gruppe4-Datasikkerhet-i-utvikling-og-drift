<?php

class Message {

private $conn;

    private $message_id;
    private $course_course_id;
    private $student_student_id;
    private $message_text;

    function_construct($course_course_id, $student_student_id, $message_text)
    $this->conn = $db;
    $this->message_id = $message_id; 

    $this->course_course_id = $course_course_id;
    $this->student_student_id = $student_student_id;
    $this->message_text = $message_text;

    public create() {
        $query = "INSERT INTO messages
            SET message_id = :message_id,
                course_course_id = :course_course_id,
                student_student_id = :student_student_id,
                message_text = :message_text"


                $stmt->bindparm(':message_id,$this->message_id');

                $stmt->bindparm(':course_course_id,$this->course_course_id');

                $stmt->bindparm(':student_student_id,$this->student_student_id');

                $stmt->bindparm(':message_text,$this->message_text');
                if($stmt->execute()) {
                    return true

                }
            }

}