<?php

class Signup extends DatabaseConnection { 

    protected function setStudent($username, $firstName, $lastName, $email, $password, $userRole, $fieldOfStudy, $startingYear) { 

        $insertUserTable = $this->connect()->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); ');
        $insertStudentTable = $this->connect()->prepare('INSERT INTO student (student_id ,field_of_study, starting_year) VALUES (? ,?, ?); ');
        $insertStudentHasUserTable = $this->connect()->prepare('INSERT INTO student_has_user (student_student_id, user_username) VALUES (?, ?)'); 

        $studentID = $this->connect()->query('SELECT COUNT(*) FROM student;')->fetchAll(PDO::FETCH_ASSOC);
        
        // Doing it like this, will not work if students are deleted in DB. 
        $studentID = 1 + $studentID[0]["COUNT(*)"];
         
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        if(!$insertUserTable->execute(array($username, $firstName, $lastName, $email, $hashedPassword, $userRole))) {
            
                $insertUserTable = null; 
                header("location: ../index.php?error=SQLstatementfailed");
                exit(); 
        }; 
        if(!$insertStudentTable->execute(array($studentID, $fieldOfStudy, $startingYear))) {

                $insertStudentTable = null; 
                header("location: ../index.php?error=SQLstatementfailed");
                exit(); 
        }; 
        if(!$insertStudentHasUserTable->execute(array($studentID, $username))) {
            
                $insertStudentHasUserTable = null;
                header("location: ../index.php?error=SQLstatementfailed");
                exit(); 
        }; 

        $insertUserTable = null; 
        $insertStudentTable = null; 
        $insertStudentHasUserTable = null; 
    
    }

    protected function setLecturer($username, $firstName, $lastName, $email, $password, $userRole, $profilePictureAdress, $courseId) { 
        $insertUserTable = $this->connect()->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); '); 
        $insertLecturerTable = $this->connect()->prepare('INSERT INTO lecturer (lecturer_id, profilepicture, course_course_id) VALUES (? ,?, ?); ');
        $insertLecturerHasUserTable = $this->connect()->prepare('INSERT INTO lecturer_has_user (lecturer_lecturer_id, user_username) VALUES (?, ?)'); 

        $lecturerID = $this->connect()->query('SELECT COUNT(*) FROM lecturer;')->fetchAll(PDO::FETCH_ASSOC);
        
        // Doing it like this, will not work if lecturerer are deleted in DB.
        $lecturerID = 1 + $lecturerID[0]["COUNT(*)"];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        if(!$insertUserTable->execute(array($username, $firstName, $lastName, $email, $hashedPassword, $userRole))) {
            $insertUserTable = null; 
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 

        if(!$insertLecturerTable->execute(array($lecturerID, $profilePictureAdress, $courseId))) {

            $insertLecturerTable = null; 
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 
        if(!$insertLecturerHasUserTable->execute(array($lecturerID, $username))) {
        
            $insertLecturerHasUserTable = null;
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 

        $insertUserTable = null; 
        $insertLecturerTable = null;
        $insertLecturerHasUserTable = null;

    }

    protected function checkUser($username, $email) {
       $statement =  $this->connect()->prepare('SELECT username FROM user WHERE username = ? OR email = ?;'); 

       if(!$statement->execute(array($username, $email))) {
           $statement = null; 
           header("location: ../index.php?error=SQLstatementfailed"); 
           exit(); 
       }

       $resultCheck = null; 
       if($statement->rowCount() > 0) {
           $resultCheck = false;  

       }
       else {
           $resultCheck = true; 
       }
       return $resultCheck; 


    } 

}