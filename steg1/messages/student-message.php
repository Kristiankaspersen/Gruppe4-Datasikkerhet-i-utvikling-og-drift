
<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />
    <title>Document</title>
</head>
<body>

    <?php
    if(isset($_SESSION["username"]) && $_SESSION["user_role"] === "student") 

    {
    ?>
        <nav>
            <ul>
                    <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                    <li><a href="#"><?php echo $_SESSION["student_id"]; ?></a></li>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../messages/student-message.php">Send message</a></li>
                    <li><a href="classes/Change_Password.php">Change Password</a></li>
                    <li><a href="includes/logout.inc.php">Logout</a></li>
            </ul>
        </nav> 
                <?php

                include "../config/DatabaseConnection.php"; 

                $conn = new DatabaseConnection();

                $query = "SELECT * FROM course"; 

                $stmt = $conn->connect()->prepare($query); 

                $stmt->execute(); 

                $num = $stmt->rowCount(); 

                echo "{$num} <br>"; 

                if($num > 0) {
                    // loop through each course linking course id and profile picture: 
                    $coursesAndProfilepicturesList = array(); 
                    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                    for($i = 0; $i < $num; $i++ ) {

                        $image_query = "SELECT * FROM lecturer WHERE course_course_id = :course_id";

                        $image_stmt = $conn->connect()->prepare($image_query); 

                        $image_stmt->bindParam(":course_id", $courses[$i]['course_id']); 

                        $image_stmt->execute(); 

                        echo "{$courses[$i]['course_id']} <br>"; 

                        if($image_stmt->rowCount() > 0) {
                            // if there is lecturer assigned to the course:

                            while($row_lecturer = $image_stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row_lecturer);

                                echo "{$profilepicture} <br>" ; 

                                $coursesAndProfilepictures = array(
                                    "{$courses[$i]['course_id']}" => $profilepicture,
                                );

                                echo "{$coursesAndProfilepictures[$courses[$i]['course_id']]} <br>"; 

                                array_push($coursesAndProfilepicturesList, $coursesAndProfilepictures); 
                            }
                        } else {
                            // if there is no lecturer assigned to the course: 
                            $coursesAndProfilepictures = array(
                                "{$courses[$i]['course_id']}" => null,
                            );

                            echo "{$coursesAndProfilepictures[$courses[$i]['course_id']]} <br>"; 

                            array_push($coursesAndProfilepicturesList, $coursesAndProfilepictures); 

                        }

                    }

                    // while($row_course = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //     extract($row_course); 

                    //     $image_query = "SELECT * FROM lecturer WHERE course_course_id = :course_id";

                    //     $image_stmt = $conn->connect()->prepare($image_query); 

                    //     $image_stmt->bindParam(":course_id", $course_id); 

                    //     $image_stmt->execute(); 

                    //     $num = $image_stmt->rowCount(); 

                    //     echo "{$course_id} <br>" ; 

                    //     if($num > 0) {

                    //         while($row_lecturer = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //             extract($row_lecturer);
                    //             echo $lecturer_id; 

                    //         }
                    //     }   
                    // }
                }   

                // $image_query = "select * from lecturer where course_course_id = '{$course_id}'";
                // if ($image_res = $mysqli->query($image_query)){
                // while (($image_row = $image_res->fetch_assoc())){
                //     extract($image_row);
                //     echo "<img src='uploads/" .$profilepicture. "' width='500px'>";
                // }
                // $image_res->free();
                        // ITF15019
                ?>


            <div id="message">
                <form action="includes/message.inc.php" method="post">
                <label for="courses">Choose the course you want to send a message:</label>

                        <br>
                        <textarea id="message-txt" name="message_text" rows="10" cols="50">     
                        </textarea>
                        <br>
                        <label for="courses">Choose the course you want to send a message:</label>
                        <select  name="course_id" id="id_select2_example" style="width: 200px;">
                        <?php
                            $num = count($coursesAndProfilepicturesList); 

                            for($i = 0; $i < $num; $i++) {

                                echo '<option value="{}" data-img_src= "../uploads/{}" >{}</option>'; 

                            }


                            <option value="ITM30617" data-img_src= "../uploads/61ff473c5520f0.42183828.png" >dsadada</option>
                            <option value="ITF15019" data-img_src="../uploads/61ff473c5520f0.42183828.png">Innføring i datasikkerhet</option>
                            <option value="BVN13092" data-img_src="">Utvikling av interaktive bavianer</option>
                            <option value="OKS12032">Innføring i okse</option>
                            ?>
                        </select>
                        <br>
                        <br>
                        <button type="submit" name="submit">Send Message</button> 
                </form>
            </div>  

    <?php
    }
    else 
    {
    ?>
    <p>You do now have access to this page, get lost, why are you here?</p>
    <?php
    }
    ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>

<script type="text/javascript">
    function custom_template(obj){
            var data = $(obj.element).data();
            var text = $(obj.element).text();
            if(data && data['img_src']){
                img_src = data['img_src'];
                template = $("<div><img src=\"" + img_src + "\" style=\"width:100%;height:150px;\"/><p style=\"font-weight: 700;font-size:14pt;text-align:center;\">" + text + "</p></div>");
                return template;
            }
        }
    var options = {
        'templateSelection': custom_template,
        'templateResult': custom_template,
    }
    $('#id_select2_example').select2(options);
    $('.select2-container--default .select2-selection--single').css({'height': '220px'});

</script>

  
</body>
</html>