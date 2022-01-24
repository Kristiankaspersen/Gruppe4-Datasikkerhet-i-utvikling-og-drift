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

            $statement = null;
        }
    
    }
}