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
    include "../../config/DatabaseConnection.php"; 
    include "../classes/Signup.php"; 
    include "../controller/SignupController.php"; 
    $signup = new SignupController($student); 

    $signup->signupStudent(); 

    // Going back to the front page
    header("location: ../index.php?error=none"); 

} else {
    echo "wrong, there is something wrong with signUpStudent button"; 
}

if(isset($_POST["submitLecturer"])) {

    echo $_FILES["file"]; 
    $file = $_FILES["file"];

    echo "$file"; 

    $fileName = $file['name']; 
    $fileTmpName = $file['tmp_name']; 
    $fileSize = $file['size']; 
    $fileError = $file['error']; 
    $fileType = $file['type']; 

    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt)); 

    $allowed = array('jpg', 'jpeg', 'png'); 

    if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
            if($fileSize < 500000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = '../../uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "You file is to big!"; 
                exit(); 
            }

        } else {
            echo "There was an error uploading your file"; 
            exit(); 

        }
    } else {
        echo "You cannot upload files of this type! Only jpg or png"; 
        exit(); 
    }

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
        $fileNameNew, 
        $_POST["course"]
    );


    // Make signup controller object. 
    include "../../config/DatabaseConnection.php"; 
    include "../classes/Signup.php"; 
    include "../controller/SignupController.php"; 
    $signup = new SignupController($lecturer); 

    $signup->signupLecturer($lecturer); 


    // Going back to the front page
    header("location: ../index.php?error=none"); 

} else {
    echo "wrong, there is something wrong with signUpLecturer button"; 
}