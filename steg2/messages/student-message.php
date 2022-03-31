
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
    <title>messages</title>
</head>
<body>

    <?php
    if(isset($_SESSION["username"]) && $_SESSION["user_role"] === "student") 

    {
    ?>
        <nav>
            <ul>
                    <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../messages/student-message.php">Send message</a></li>
                    <li><a href="../../steg2/auth/Change_Password.php">Change Password</a></li>
                    <li><a href="../../steg2/auth/includes/logout.inc.php">Logout</a></li>
            </ul>
        </nav> 
                <?php

                include "../config/DatabaseConnection.php"; 

                $conn = new DatabaseConnection();

                $query = "SELECT * FROM course"; 

                $stmt = $conn->connect()->prepare($query); 

                $stmt->execute(); 

                $num = $stmt->rowCount(); 

                if($num > 0) 
                {
                    // loop through each course linking course id and profile picture: 
                    $coursesAndProfilepictures = array(); 
                    while ($row_course = $stmt->fetch(PDO::FETCH_ASSOC))
                    {

                        extract($row_course); 

                        $image_query = "SELECT * FROM lecturer WHERE course_course_id = :course_id";

                        $image_stmt = $conn->connect()->prepare($image_query); 

                        $image_stmt->bindParam(":course_id", $course_id); 

                        $image_stmt->execute(); 


                        if($image_stmt->rowCount() > 0) 
                        {
                            // if there is lecturer assigned to the course:
                            while($row_lecturer = $image_stmt->fetch(PDO::FETCH_ASSOC)) 
                            {
                                extract($row_lecturer);

                                $option = '<option value="'. $course_id . '" data-img_src="../uploads/' . $profilepicture . '">' . $course_name . ' </option>'; 
                                array_push($coursesAndProfilepictures, $option); 


                            }
                        } else 
                        {
                            // if there is no lecturer assigned to the course: 
                            $NoProfilePictureDefault = "default.png";   
                            array_push($coursesAndProfilepictures, '<option value="'. $course_id . '" data-img_src="../uploads/' . $NoProfilePictureDefault . '">' . $course_name . ' </option>');
                            
                        }

                    }
                }   

                ?>

            <div id="message">
                <form action="includes/message.inc.php" method="post">
                <label for="courses">Choose the course you want to send a message to:</label>

                        <br>
                        <textarea id="message-txt" name="message_text" rows="10" cols="50">     
                        </textarea>
                        <br>
                        <label for="courses">Choose the course you want to send a message:</label>
                        <select  name="course_id" id="id_select2_example" style="width: 200px;">
                        <?php
                            $num = count($coursesAndProfilepictures); 
                
                            for($i = 0; $i < $num; $i++) {

                                echo $coursesAndProfilepictures[$i]; 
                               
                            }
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