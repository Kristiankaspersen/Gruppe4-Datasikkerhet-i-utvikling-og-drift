<?php
if (isset($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8)); 
    $token = random_bytes(32);

    $url = "steg1\auth\create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    

    require '../../config\sqliDbConn.php';

    $email = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error   faen";
        exit();
    }else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $email, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);


    $to = "katrinehoyem@hotmail.com";
    $subject = 'Reset your password';

    $message = '<p>Follow this link to reset your password, if you do not need to reset your password then ignore this email. </br> Here is your password link</p>';
    $message .= '<a href="'  . $url . '">' . $url . '<a/></p>';

    $headers = "From: gruppefire <gruppefire@outlook.com>\r\n";
    $headers .= "Reply-To: gruppefire@outlook.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    mail($to, $subject, $message, $headers);

    header("Location: ../forgotpassword.php?reset=succsess ");
} else {
    header ("Location: ../index.php");
}


?>