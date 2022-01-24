<?php

if(isset($_POST["submitStudent"])) {

    include "../classes/models/User.php";
    include "../classes/models/Student.php"; 

    // Grabbing the data, and making a new student object. 
    $student = new Student(
        $_POST["username"], 
        $_POST["first_name"], 
        $_POST["last_name"], 
        $_POST["email"], 
        $_POST["password"], 
        $_POST["passwordRepeat"],
        $_POST["fieldOFStudy"],
        $_POST["startingYear"], 
    ); 
  
    // Make signup controller object. 
    include "../classes/database-connection.classes.php"; 
    include "../classes/signup.classes.php"; 
    include "../classes/signup-controller.classes.php"; 
    $signup = new SignupController($student); 

    $signup->signupStudent(); 

    // Going back to the front page
    header("location: ../index.php?error=none"); 

} 

if(isset($_POST["sign up Lecturer"])) {

    include "../classes/models/User.php";
    include "../classes/models/Lecturer.php";

    // Grabbing the data
    $lecturer = new Lecturer(
        $_POST["username"], 
        $_POST["first_name"], 
        $_POST["last_name"], 
        $_POST["email"], 
        $_POST["password"], 
        $_POST["passwordRepeat"], 
        "testProfilePicture.png", 
        $_POST["course"]
    );


    // Make signup controller object. 
    include "../classes/database-connection.classes.php"; 
    include "../classes/signup.classes.php"; 
    include "../classes/signup-controller.classes.php"; 
    $signup = new SignupController($lecturer); 

    $signup->signupLecturer($lecturer); 


    // Going back to the front page
    header("location: ../index.php?error=none"); 

}