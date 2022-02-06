
<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION["username"]) && $_SESSION["user_role"] === "student") 
    {
    ?>
        <nav>
        <ul>
            <?php 
                if(isset($_SESSION["username"]) && $_SESSION["user_role"] === "student") 
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="#"><?php echo $_SESSION["student_id"]; ?></a></li>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../messages/student-message.php">Send message</a></li>
                <li><a href="classes/Change_Password.php">Change Password</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>

            <?php
                }
                elseif(isset($_SESSION["username"]) && $_SESSION["user_role"] === "lecturer")
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="#"><?php echo $_SESSION["lecturer_id"]; ?></a></li>
                <li><a href="classes/Change_Password.php">Change Password</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>
                
            <?php
                }
                else 
                {
            ?>
                <li><a href="#">Sign up</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="forgotpassword.php">Glemt passord?</a></li>
            <?php
                }
            ?>
        </ul>
    </nav> 
    <div id="message">
        <form action="includes/message.inc.php" method="post">
        <label for="courses">Choose the course you want to send a message:</label>
                <select id="course" name="course_id">
                    <option value="ITM30617">Utvikling av interaktive nettsteder</option>
                    <option value="ITF15019">Innføring i datasikkerhet</option>
                    <option value="BVN13092">Utvikling av interaktive bavianer</option>
                    <option value="OKS12032">Innføring i okse</option>
                </select>
                
                <textarea id="message-txt" name="message_text" rows="10" cols="50">
                At w3schools.com you will learn how to make a website. They offer free tutorials in all web development technologies.
                </textarea>
                
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

    
</body>
</html>