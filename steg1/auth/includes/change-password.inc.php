<?php 

session_start(); 

if(isset($_POST["submit"])) {

    //clean input data: 
    $username = $_SESSION['username']; 
    $oldPassword = htmlspecialchars(strip_tags($_POST['oldPassword']));

    $newPassword = htmlspecialchars(strip_tags($_POST['newPassword'])); 
    $newPasswordRepeat = htmlspecialchars(strip_tags($_POST['newPasswordRepeat'])); 

    // do a check here if password repeat and newpassword is the same: 

    include "../../config/DatabaseConnection.php"; 

    $conn = new DatabaseConnection(); 

    $stmt = $conn->connect()->prepare('SELECT password FROM user WHERE username = ?');


    if(!$stmt->execute(array($username))) {
        $stmt = null; 
        header("location: ../index.php?error=SQLstatementfailed");
        exit(); 
    }; 

    $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $checkPassword = password_verify($oldPassword, $passwordHashed[0]["password"]); 

    if($checkPassword == false) { 

        $stmt = null; 
        header("location: ../index.php?error=wrongpassword"); 
        exit(); 
    } elseif($checkPassword == true) {
        $stmt = $conn->connect()->prepare('UPDATE user SET password = :new_password WHERE username = :username;');

        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); 

        $stmt->bindParam(":new_password", $newHashedPassword); 
        $stmt->bindParam(":username", $username); 

        if(!$stmt->execute()) {
            $stmt = null; 
            header("location: ../index.php?error=SqlStatementFaild"); 
            exit(); 
        }
    }

    header("location: ../index.php?error=none");
    
    echo "your password have been updated"; 

}