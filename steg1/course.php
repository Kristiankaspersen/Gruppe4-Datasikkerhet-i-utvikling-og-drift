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

else if (isset($_SESSION["username"])){
    $query = "select username, user_role from user where username = '{$_SESSION['username']}'";
    if ($result = $mysqli->query($query)){
        while(($row = $result->fetch_assoc())){
            if ($row["user_role"] == "lecturer"){
                // saving lecturer id in session is not implemented. 
                // set as 1 to test
                $_SESSION["lecturer_id"] = 1;
                $newquery = "select lecturer_id, course_course_id from lecturer where lecturer_id = '{$_SESSION['lecturer_id']}'";
                if ($newresult = $mysqli->query($newquery)){
                    while(($newrow = $newresult->fetch_assoc())){
                        if ($newrow["course_course_id"] == $_GET["course"]){
                            $has_lecture_access = TRUE; 
                        }
                        else{
                            echo "<h1>Du er ikke foreleser i dette emnet, <a href='courses.php'>Gå tilbake</a></h1>";
                        }
                    }   
                $newresult->free(); 
                }
            }
        }    
        $result->free();    
    }
}
else{
    echo "<h1>Du har ikke tilgang til dette emnet, <a href='courses.php'>Gå tilbake</a></h1>";
}

if ($has_lecture_access == TRUE){
    echo "<h1>Foreleser i dette emnet logget inn</h1>";
}

?>
<h2><a href=""></a></h2>
</body>
</html>