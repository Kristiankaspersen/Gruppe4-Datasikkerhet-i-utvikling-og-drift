<?php

class Login extends DatabaseConnection { 

    protected function getUser($usernameOrEmail, $password) { 
        $statement = $this->connect()->prepare('SELECT password FROM user WHERE username = ? OR email = ?'); 

        if(!$statement->execute(array($usernameOrEmail, $usernameOrEmail))) {
            $statement = null; 
            header("location: ../index.php?error=SQLstatementfailed");
            exit(); 
        }; 

        $passwordHashed = $statement->fetchAll(PDO::FETCH_ASSOC);

        $checkPassword = password_verify($password, $passwordHashed[0]["password"]); 

        if($checkPassword == false) { 

            $statement = null; 
            header("location: ../index.php?error=wrongpassword"); 
            exit(); 
        } elseif($checkPassword == true) {
            $statement = $this->connect()->prepare('SELECT * FROM user WHERE username = ? OR email = ? AND password = ?;');

            if(!$statement->execute(array($usernameOrEmail, $usernameOrEmail, $password))) {
                $statement = null; 
                header("location: ../index.php?error=SqlStatementFaild"); 
                exit(); 
            }

            if($statement->rowCount() == 0) { 
                $statement = null; 
                header("location: ../index.php?error=usernotfound");
                exit(); 
            }


            $user = $statement->fetchAll(PDO::FETCH_ASSOC); 

            session_start(); 
            $_SESSION["username"] = $user[0]["username"]; 


            if ($user[0]["user_role"] === "lecturer") {

                $lecturerStmt = $this->connect()->prepare('SELECT * FROM lecturer_has_user WHERE user_username = ?;'); 

                $lecturerStmt->execute(array($user[0]["username"])); 

                $lecturer_has_user = $lecturerStmt->fetchAll(PDO::FETCH_ASSOC);

                $_SESSION["user_role"] = $user[0]["user_role"]; 
                $_SESSION["lecturer_id"] = $lecturer_has_user[0]["lecturer_lecturer_id"]; 

            } elseif ($user[0]["user_role"] === "student") {

                $studentStmt = $this->connect()->prepare('SELECT * FROM student_has_user WHERE user_username = ?;'); 

                $studentStmt->execute(array($user[0]["username"])); 

                $student_has_user = $studentStmt->fetchAll(PDO::FETCH_ASSOC);

                $_SESSION["user_role"] = $user[0]["user_role"]; 
                $_SESSION["student_id"] = $student_has_user[0]["student_student_id"]; 

            } else {
                echo "your user is either lecturer or student, 
                so you don't get any session information, 
                maybe you are admin, but we don't give a shit about you"; 
            }


            $statement = null;
        }
    
    }
}