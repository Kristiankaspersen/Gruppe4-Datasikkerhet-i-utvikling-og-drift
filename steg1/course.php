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
<h2><a href="../steg1/index.php">Gå tilbake</a></h2>
<?php
include "config/mysqliConn.php";

$has_pin_access = FALSE;
$has_lecture_access = FALSE;
$has_student_access = FALSE;

if (isset($_GET['course'])){
    $course_id = $_GET['course'];
}

if (isset($_POST["pin_code"])){
    $query = "select course_id, course_name from course where pin_code = '{$_POST['pin_code']}'";
    if ($result = $mysqli->query($query)){
        while(($row = $result->fetch_assoc())){
            $course_id = $row["course_id"];
            $course_name = $row["course_name"];
            
            $has_pin_access = TRUE;
            
        }    
        $result->free();    
    }
}

else if (isset($_SESSION["username"])){
    $query = "select username, user_role from user where username = '{$_SESSION['username']}'";
    if ($result = $mysqli->query($query)){
        while(($row = $result->fetch_assoc())){
            if ($row["user_role"] == "lecturer"){
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
            else{
                $has_student_access = TRUE;
            }
        }    
        $result->free();    
    }
}

if ($has_lecture_access == TRUE){
    header("Location: messages/reply-message.php");
    exit();
}
else if ($has_student_access == TRUE){
    header("Location: messages/student-message.php");
    exit();
}
else if ($has_pin_access == TRUE){
    // display image here
    $image_query = "select * from lecturer where course_course_id = '{$course_id}'";
    if ($image_res = $mysqli->query($image_query)){
        while (($image_row = $image_res->fetch_assoc())){
            extract($image_row);
            echo "<img src='uploads/" .$profilepicture. "' width='500px'>";
        }
        $image_res->free(); 
    } 

    $query = "select message_id, message_text from message where course_course_id = '{$course_id}'";
    echo "<h1>Meldinger i {$course_id}</h1>";
    if ($result = $mysqli->query($query)){
        $all_id_for_messages = array(); 
        $i = 0; 
        while(($row = $result->fetch_assoc())){
            $all_id_for_messages[$i] = '<option value="'. $row["message_id"] . '">'.$row["message_id"].'</option>';
            $i++; 
            echo "<h2>Id: {$row['message_id']}</h3> <p>{$row['message_text']}</p>";

            $new_query = "SELECT * FROM `reply` where message_message_id = '{$row['message_id']}'"; 
            if ($newresult = $mysqli->query($new_query)){
                echo "<h3> Svar : </h3>"; 
                while(($newrow = $newresult->fetch_assoc())){
                    echo "<p>{$newrow['reply_text']}";
                }
                $newresult->free(); 
            }

            $commentquery = "SELECT * FROM `comment` WHERE message_message_id = '{$row['message_id']}'"; 
            if ($commentresult = $mysqli->query($commentquery)){
                echo "<h3> Kommentarer : </h3>"; 
                while(($commentrow = $commentresult->fetch_assoc())){
                    echo "<p>{$commentrow['comment_text']}";
                }
                $commentresult->free(); 
            }

        }
        $result->free();
    }

    ?>
                            <div class="reply-box">
                        <form action="messages/includes/comment.inc.php" method="post">
                            <label for="courses">Send comment to message id:</label>
                            <select id="course" name="comment_id">
                                <?php
                                foreach ($all_id_for_messages as $id)  {
                                    echo $id ."<br />";
                                }
                                ?>
                            </select>
                            <br>
                            <textarea id="comment-txt" name="comment_text" rows="10" cols="50">
                            </textarea>
                            <br>
                            <button class="btn" type="submit" name="submit">Send reply</button> 
                        </form>
                     </div>  

    <?php 
}
else {
    echo "<h1>Du har ikke tilgang til dette emnet, <a href='courses.php'>Gå tilbake</a></h1>";
}

?>
<h2><a href=""></a></h2>
</body>
</html>