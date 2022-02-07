
<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION["username"]) && $_SESSION["user_role"] === "lecturer") 
    {

        ?>
        <nav>
            <ul>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="#"><?php echo $_SESSION["lecturer_id"]; ?></a></li>
                <li><a href="classes/Change_Password.php">Change Password</a></li>
                <li><a href="../messages/reply-message.php">Answer messages</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>
            </ul>
        </nav> 
        <?php

        include "../config/DatabaseConnection.php";
        
        $conn = new DatabaseConnection(); 

        $stmt = $conn->connect()->prepare("SELECT * FROM message WHERE course_course_id = :course_id"); 

        $stmt->bindParam(":course_id", $_SESSION["course_id"]); 

        $stmt->execute(); 

        $num = $stmt->rowCount(); 

        if($num > 0) { 

            $i = 0; 
            $all_id_for_messages = array(); 
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row); 
                
                echo '<div class="message-box">'; 
                echo "message id: ". $message_id . "<br>";
                echo "<br>"; 
                echo $message_text . "<br>";
                echo "<br>"; 

                echo '</div>'; 

                $replyStmt = $conn->connect()->prepare("SELECT * FROM reply WHERE message_message_id = :message_id"); 

                $replyStmt->bindParam(":message_id", $message_id); 

                $replyStmt->execute(); 

                $num = $replyStmt->rowCount();

                if($num > 0) {
                    $replyInfo = $replyStmt->fetchAll(PDO::FETCH_ASSOC); 

                    echo '<div class="message-box">'; 
                    echo "answer on message id: ". $replyInfo[0]["message_message_id"] . "<br>";
                    echo "<br>"; 
                    echo $replyInfo[0]["reply_text"] . "<br>";
                    echo "<br>"; 
    
                    echo '</div>'; 

                     
                } else {
                    $all_id_for_messages[$i] = '<option value="'. $message_id. '">'.$message_id.'</option>';
                    $i++;

                }
                // Can just change the box underneath to point to comment.inc.php, and it will be the same solution
            }
            ?>

            <?php 
                if(empty($all_id_for_messages)) {
                    echo "There is nothing to reply on"; 
                } else {
                    ?>
                        <div class="reply-box">
                        <form action="includes/reply.inc.php" method="post">
                            <label for="courses">Send reply to message id:</label>
                            <select id="course" name="message_id">
                                <?php
                                foreach ($all_id_for_messages as $id)  {
                                    echo $id ."<br />";
                                }

                                ?>
                            </select>
                            <br>
                            <textarea id="reply-txt" name="reply_text" rows="10" cols="50">
                            </textarea>
                            <br>
                            <button class="btn" type="submit" name="submit">Send reply</button> 
                        </form>
                     </div>  


                    <?php
                }
            ?>
    
                     <?php
        } else {
            echo "There are no messages in the course"; 
        }
    ?>

    <?php
    }
    else 
    {
    ?>
    <p>You do now have access to this page, get lost, why are you here?</p>
    <?php
    }
    ?>

    
</body>
</html>