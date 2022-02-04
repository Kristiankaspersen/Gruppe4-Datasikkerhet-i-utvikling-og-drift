<?php 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Steg1-Gruppe4</title>
</head>
<body>
<?php
// Change for server
$servername = "localhost:3308";
$username = "root";
$password = "root";
$dbName = "GruppeFireDB";

$mysqli = new mysqli($servername, $username, $password, $dbName);

echo "<h1>" .$_GET['course']. "</h1>";

$has_pin_access = FALSE;
$has_lecture_access = FALSE;

if (isset($_POST["pin_code"])){
    $query = "select course_id, course_name from course where pin_code = '{$_POST['pin_code']}'";
    if ($result = $mysqli->query($query)){
        while(($row = $result->fetch_assoc())){
            $courseId = $row["course_id"];
            $courseName = $row["course_name"];
            
            echo "
            <tr>
            <td><a href='course.php?course=".$courseId."'>" .$courseId. "</a></td>
                <td>" .$courseName. "</td>
            </tr>";
            
        }    
        $result->free();    
    }
}
else{
    echo "You do not have access to this course";
}


// TODO
// course code on top, can be retrieved with $_GET['course'] (param in url)
// if logged in user is lecturer in course, display all messages, option to reply to messages
// else if access through pin, display all messages, option to comment on messages
// else display message

// if lecture access
// else  if pin access
// else if student access
// else, no access




// if (isset($_GET["pin"])){
//     echo "HERE"
//     // $query = "SELECT * from course where pin_code = {$_GET['pin']}";
//     // $result = $mysqli->query($query)
//     // if ($result){
//     //     $has_pin_access = TRUE;
//     // $result->free();
// }

// echo $is_lecturer;
// echo $has_pin_access;

// if (isset($_SESSION["username"])){
//     $query = "SELECT * from user where username = {$_SESSION['username']}";
//     if ($result = $mysqli->query($query)){
//         while(($row = $result->fetch_assoc())){
//             if ($row["user_role"] == "lecturer"){
//                 $lecturer_course = 
//                 $new_query = "select course_id from course where course_id = lecturer.course_course_id";
//                 if ($new_result = $mysqli->query($new_query)){
//                     $is_lecturer = TRUE; 
//                     $new_result->free();
//                 }
//             }
//         }
//         $result->free();
//     }

// }



?>
<h2><a href=""></a></h2>
</body>
</html>