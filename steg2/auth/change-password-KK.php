<?php

session_start(); 

if(isset($_SESSION["username"])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
</head>
<body>
<nav>
        <ul>
            <?php 
                if($_SESSION["user_role"] === "student") 
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="../messages/student-message.php">Send message</a></li>
                <li><a href="change-password-KK.php">Change Password</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>

            <?php
                }
                elseif($_SESSION["user_role"] === "lecturer")
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="../messages/reply-message.php">Send message</a></li>
                <li><a href="change-password-KK.php">Change Password</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>
                <?php } ?>
                
        </ul>
    </nav> 
    <div>
        <form action="includes/change-password.inc.php" method="post">
            <input type="password" name="oldPassword" placeholder="old password">
            <input type="password" name="newPassword" placeholder="new password">
            <input type="password" name="newPasswordRepeat" placeholder="repeat new password">
            <button type="submit" name="submit">Change password</button> 
        </form>
    </div>
 
</body>
</html>

<?php } ?>