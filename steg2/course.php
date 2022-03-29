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

    $stmt = $mysqli->prepare("SELECT course_id, course_name from course where pin_code = ? ");
    $stmt->bind_param("i", $_POST['pin_code']);
    $stmt->execute(); 

    if ($result = $stmt->get_result()){
        while(($row = $result->fetch_assoc())){
            $course_id = $row["course_id"];
            $course_name = $row["course_name"];
            
            $has_pin_access = TRUE;
            
        }    
        $result->free();    
    }
}

else if (isset($_SESSION["username"])){
    //$query = "SELECT username, user_role from user where username = '{}'";

    $stmt = $mysqli->prepare("SELECT username, user_role from user where username = ? ");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();

    if ($result = $stmt->get_result()){
        while(($row = $result->fetch_assoc())){
            if ($row["user_role"] == "lecturer"){
                //$newquery = "SELECT lecturer_id, course_course_id from lecturer where lecturer_id = '{$_SESSION['lecturer_id']}'";
                
                $stmt2 = $mysqli->prepare("SELECT lecturer_id, course_course_id from lecturer where lecturer_id = ? ");
                $stmt2->bind_param("i", $_SESSION['lecturer_id']);
                $stmt2->execute();

                if ($result2 = $stmt2->get_result()){
                    while(($newrow = $result2->fetch_assoc())){
                        if ($newrow["course_course_id"] == $_GET["course"]){
                            $has_lecture_access = TRUE; 
                        }
                        else{
                            echo "<h1>Du er ikke foreleser i dette emnet, <a href='courses.php'>Gå tilbake</a></h1>";
                        }
                    }   
                $result2->free(); 
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
    //$image_query = "SELECT * from lecturer where course_course_id = '{$course_id}'";
    
    $imgstmt = $mysqli->prepare("SELECT * from lecturer where course_course_id = ? ");
    $imgstmt->bind_param("s", $course_id);
    $imgstmt->execute();

    if ($image_res = $imgstmt->get_result()){
        while (($image_row = $image_res->fetch_assoc())){
            extract($image_row);
            echo "<img src='uploads/" .$profilepicture. "' width='500px'>";
        }
        $image_res->free(); 
    } 

    //$query = "SELECT message_id, message_text from message where course_course_id = '{$course_id}'";
    
    $stmt = $mysqli->prepare("SELECT message_id, message_text from message where course_course_id = ? ");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();

    echo "<h1>Meldinger i {$course_id}</h1>";
    if ($result = $stmt->get_result()){
        $all_id_for_messages = array(); 
        $i = 0; 
        while(($row = $result->fetch_assoc())){
            $all_id_for_messages[$i] = '<option value="'. $row["message_id"] . '">'.$row["message_id"].'</option>';
            $i++; 
            echo "<h2>Id: {$row['message_id']}</h3> <p>{$row['message_text']}</p>";

            $new_query = "SELECT * FROM `reply` where message_message_id = '{$row['message_id']}'";
             
            $stmt = $mysqli->prepare("SELECT * FROM `reply` where message_message_id = ? ");
            $stmt->bind_param("i", $row['message_id']);
            $stmt->execute();


            if ($result2 = $stmt2->get_result()){
                echo "<h3> Svar : </h3>"; 
                while(($newrow = $result2->fetch_assoc())){
                    echo "<p>{$newrow['reply_text']}";
                }
                $result2->free(); 
            }

            // $commentquery = "SELECT * FROM `comment` WHERE message_message_id = '{$row['message_id']}'"; 
            
            $stmt = $mysqli->prepare("SELECT * FROM `comment` WHERE message_message_id = ? ");
            $stmt->bind_param("i", $row['message_id']);
            $stmt->execute();

            if ($commentresult = $commentstmt->get_result()){
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