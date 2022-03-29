<?php

class Signup extends DatabaseConnection { 

    protected function setStudent($username, $firstName, $lastName, $email, $password, $userRole, $fieldOfStudy, $startingYear) { 

        $insertUserTable = $this->connect()->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); ');
        $insertStudentTable = $this->connect()->prepare('INSERT INTO student (student_id ,field_of_study, starting_year) VALUES (? ,?, ?); ');
        $insertStudentHasUserTable = $this->connect()->prepare('INSERT INTO student_has_user (student_student_id, user_username) VALUES (?, ?)'); 

        $studentID = $this->connect()->query('SELECT COUNT(*) FROM student;')->fetchAll(PDO::FETCH_ASSOC);
        
        // Doing it like this, will not work if students are deleted in DB. 
        $studentID = $studentID[0]["COUNT(*)"];
        
        // Checks if student_id exists: 
        $checkIfStudentIdExists = null; 
        do {
            $studentID +=1;
            $checkIfStudentIdExists = $this->connect()->query("SELECT student_id FROM student WHERE student_id = $studentID")->fetchAll(PDO::FETCH_ASSOC);
            $checkIfStudentIdExists = $checkIfStudentIdExists[0]["student_id"];

        } while($checkIfStudentIdExists != null); 
         
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
        // Intead of doing this, you should use auto increment, and then get that id, and insert that in lecturer_has user. 
        $lecturerID = $lecturerID[0]["COUNT(*)"];

        // Checks if lecturer_id exists: 
        $checkIfLecturerIdExists = null; 
        do {
            $lecturerID +=1;
            $checkIfLecturerIdExists = $this->connect()->query("SELECT lecturer_id FROM lecturer WHERE lecturer_id = $lecturerID")->fetchAll(PDO::FETCH_ASSOC);
            $checkIfLecturerIdExists = $checkIfLecturerIdExists[0]["lecturer_id"];

        } while($checkIfLecturerIdExists != null);

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