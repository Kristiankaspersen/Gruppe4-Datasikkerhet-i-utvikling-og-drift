<?php

if (isset($_POST["reset-password-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../create-new-password.php");
    exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../create-new-password.php");
        exit();
    }

    $currentDate = date("U");

    require 'DatabaseConnection.php'


    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare)($stmt, $sql){
        echo "There was an error";
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqi_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.";
        exit();
        } else {
        
        $tokenBin = hex2bin($validator)
        $tokenCheck _= password_verify($tokenBin, $row["pwdResetToken"]);

        if ($tokenCheck === false) {

        } elseif($tokenCheck === true) {
            $tokenEmail = $row ['pwdRsetEmail'];

            $sql = "SELECT * FROM users WHERE emailUsers=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare)($stmt, $sql){
                echo "There was an error";
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail)
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqi_fetch_assoc($result)) {
                    echo "There was an error";
                exit();
                } else {
                
                $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                
                
                }
            }
        }
    }
}



} else {
    header("Location: ../index.php")
}



?>
