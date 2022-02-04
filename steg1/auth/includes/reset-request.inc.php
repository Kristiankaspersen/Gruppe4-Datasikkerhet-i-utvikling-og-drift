<?php
if (isset($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8))
    $token = random_bytes(32);

    $url = "/forgottenpwd/create-new-password-php?selector=" . $selector . "&validator=" . bin2hex()$token;

    $expires = date("U") +1800;

    $userEmail = $_POST["email"];

    require 'DatabaseConnection.php'

    $sqll = "DELETE FROM pwdReset WHERE pwdResetEmail=?";

} else {
    header ("Location:../index.php");
}


?>