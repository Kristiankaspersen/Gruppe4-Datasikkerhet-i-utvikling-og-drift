<?php

if(isset($_POST["submitStudent"])) {

    include "../../models/User.php";
    include "../../models/Student.php"; 

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
    include "../controller/signup-controller.classes.php"; 
    $signup = new SignupController($student); 

    $signup->signupStudent(); 

    // Going back to the front page
    header("location: ../index.php?error=none"); 

} else {
    echo "wrong, there is something wrong with signUpStudent button"; 
}

if(isset($_POST["submitLecturer"])) {

    include "../../models/User.php";
    include "../../models/Lecturer.php";

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
    include "../controller/signup-controller.classes.php"; 
    $signup = new SignupController($lecturer); 

    $signup->signupLecturer($lecturer); 


    // Going back to the front page
    header("location: ../index.php?error=none"); 

} else {
    echo "wrong, there is something wrong with signUpLecturer button"; 
}