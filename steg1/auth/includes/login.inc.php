<?php

if(isset($_POST["submit"])) {
    // Grabbing the data
    $usernameOrEmail = $_POST["usernameOrEmail"]; 
    $password = $_POST["password"];   

    // Make signup controller object. 
    include "../classes/database-connection.classes.php"; 
    include "../classes/login.classes.php"; 
    include "../controller/login-controller.classes.php"; 
    $login = new LoginController($usernameOrEmail, $password); 

    $login->loginUser(); 

    // Going back to the front page 

    header("location: ../index.php?error=none"); 
}