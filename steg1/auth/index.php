<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
<h2><a href="../">Gå tilbake</a></h2>
    <nav>
        <ul>
            <?php 
                if(isset($_SESSION["username"]) && $_SESSION["user_role"] === "student") 
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="../messages/student-message.php">Send message</a></li>
                <li><a href="change-password-KK.php">Change Password</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>

            <?php
                }
                elseif(isset($_SESSION["username"]) && $_SESSION["user_role"] === "lecturer")
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="../messages/reply-message.php">Send message</a></li>
                <li><a href="change-password-KK.php">Change Password</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>
                
            <?php
                }
                else 
                {
            ?>
                <li><a href="index.php">Sign up/Login</a></li>
                <li><a href="forgotpassword.php">Glemt passord?</a></li>
        </ul>
    </nav> 
    <section class="index-login">
        <div>
            <h4>Sign up student</h4>
            <p>If you have no account, sign up here!</p>
            <form action="includes/signup.inc.php" method="post">
            <input type="text" name="username" placeholder="username">
                <input type="text" name="first_name" placeholder="first name">
                <input type="text" name="last_name" placeholder="last name">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="passwordRepeat" placeholder="Repeat password">
                <input type="text" name="email" placeholder="E-mail">
                <input type="text" name="fieldOFStudy" placeholder="field of study">
                <input type="text" name="startingYear" placeholder="starting year">

                <br>
                <button type="submit" name="submitStudent">SIGN UP </button> 
            </form>
        </div>  
        <br>
        <div>
            <h4>Sign up lecturer</h4>
            <p>If you have no account, sign up here!</p>
            <form action="includes/signup.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="username" placeholder="username">
                <input type="text" name="first_name" placeholder="first name">
                <input type="text" name="last_name" placeholder="last name">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="passwordRepeat" placeholder="Repeat password">
                <input type="text" name="email" placeholder="E-mail">
                <label for="courses">Choose a course:</label>
                <select id="course" name="course">
                    <option value="ITM30617">Utvikling av interaktive nettsteder</option>
                    <option value="ITF15019">Innføring i datasikkerhet</option>
                    <option value="BVN13092">Utvikling av interaktive bavianer</option>
                    <option value="OKS12032">Innføring i okse</option>
                </select>
                <input type="file" name="file">
                <br>
                <button type="submit" name="submitLecturer">Sign up lecturer</button>
            </form>
        </div> 
        <br>
        <div> 
            <h4>Login</h4> 
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="usernameOrEmail" placeholder="Username or email">
                <input type="password" name="password" placeholder="Password">
                <br>
                <button type="submit" name="submit">Login</button>
                
            </form>
        </div>


    </section> 
    <?php
                }
            ?>

    
</body>
</html>