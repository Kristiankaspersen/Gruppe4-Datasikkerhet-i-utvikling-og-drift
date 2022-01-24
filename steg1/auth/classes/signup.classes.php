<?php

class Signup extends DatabaseConnection { 

    protected function setStudent($username, $firstName, $lastName, $email, $password, $userRole, $fieldOfStudy, $startingYear) { 

        $statementUserTable = $this->connect()->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); ');
        $statementStudentTable = $this->connect()->prepare('INSERT INTO student (student_id ,field_of_study, starting_year) VALUES (? ,?, ?); ');
        $statementStudentHasUserTable = $this->connect()->prepare('INSERT INTO student_has_user (student_student_id, user_username) VALUES (?, ?)'); 

        $studentID = $this->connect()->query('SELECT COUNT(*) FROM student;')->fetchAll(PDO::FETCH_ASSOC);
        
        $studentID = 1 + $studentID[0]["COUNT(*)"];
         
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        if(!$statementUserTable->execute(array($username, $firstName, $lastName, $email, $hashedPassword, $userRole))) {
            
                $statementUserTable = null; 
                header("location: ../index.php?error=SQLstatementfailed");
                exit(); 
        }; 
        if(!$statementStudentTable->execute(array($studentID, $fieldOfStudy, $startingYear))) {

                $statementStudentTable = null; 
                header("location: ../index.php?error=SQLstatementfailed");
                exit(); 
        }; 
        if(!$statementStudentHasUserTable->execute(array($studentID, $username))) {
            
                $statementStudentHasUserTable = null;
                header("location: ../index.php?error=SQLstatementfailed");
                exit(); 
        }; 

        // && $statementStudentTable->execute(array($studentID, $fieldOfStudy, $startingYear))
        // && $statementStudentHasUserTable->execute(array($studentID, $username))

        $statementUserTable = null; 
        $statementStudentTable = null; 
        $statementStudentHasUserTable = null; 
        

    }

    protected function setLecturer($username, $firstName, $lastName, $email, $password, $userRole, $profilePictureAdress) { 
        $statement = $this->connect()->prepare('INSERT INTO user (username, first_name, last_name, email, password, user_role ) VALUES (?, ?, ?, ?, ?, ?); '); 
        $statementLecturerTable = $this->connect()->prepare('INSERT INTO lecturer (lecturer_id, profilepicture ) VALUES (? ,?); ');
        $statementLecturerHasUserTable = $this->connect()->prepare('INSERT INTO lecturer_has_user (lecturer_lecturer_id, user_username) VALUES (?, ?)'); 

        $lecturerID = $this->connect()->query('SELECT COUNT(*) FROM lecturer;')->fetchAll(PDO::FETCH_ASSOC);
        
        $lecturerID = 1 + $lecturerID[0]["COUNT(*)"];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        if(!$statement->execute(array($username, $firstName, $lastName, $email, $hashedPassword, $userRole))) {
            $statement = null; 
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 

        if(!$statementLecturerTable->execute(array($lecturerID, $profilePictureAdress))) {

            $statementLecturerTable = null; 
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 
        if(!$statementLecturerHasUserTable->execute(array($lecturerID, $username))) {
        
            $statementLecturerHasUserTable = null;
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 

        $statement = null; 

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