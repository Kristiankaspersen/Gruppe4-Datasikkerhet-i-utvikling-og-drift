<?php
if (isset($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8)); 
    $token = random_bytes(32);

    $url = "/auth/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex()$token;

    $expires = date("U") +1800;

    $userEmail = $_POST["email"];

    require 'DatabaseConnection.php';

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare)($stmt, $sql){
        echo "There was an error";
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
        header("Location: ../http://158.39.188.204/steg1/auth/")
    }
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpire) VALUES (?, ?, ?, ?)"; 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare)($stmt, $sqll){
        echo "There was an error";
        exit();
    }else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sssss", $userEmail, $selector,$hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close();

    $to = $userEmail;
    $subject = 'Reset your password';

    $message = '<p>Follow this link to reset your password, if you do not need to reset your password then ignore this email. </br> Here is your password link</p>';
    $message .= '<a href="'  . $url . '">' . $url . '<a/><p>';

    $headers = "From: Gruppefire <gruppefire@outlook.com>\r\n";
    $headers .= "Reply-To: gruppefire@outlook.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to,$subject, $message, $headers);

    header("Location:../forgotpassword.php?reset=succsess ");
} else {
    header ("Location:http://158.39.188.204/steg1/auth/");
}


?>