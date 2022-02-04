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

    <nav>
        <ul>
            <?php 
                if(isset($_SESSION["username"])) 
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>
            <?php
                }
                else 
                {
            ?>
                <li><a href="#">Sign up</a></li>
                <li><a href="#">Login</a></li>
            <?php
                }
            ?>
        </ul>
    </nav> 
    <section class="index-login">
        <div>
            <h4>Forgot password</h4>
            <p>If you have no account, sign up here!</p>
            <form action="includes/reset-password.inc.php" method="post">
                <input type="text" name="email" placeholder="Enter your E-mail">
                <br>
                <button type="submit" name="reset-request-submit">Send reset link</button> 
            </form>
        </div>  
        <br>
        <br>
        <div> 
            <h4>Login</h4> 
            <form action="includes/reset-request.inc.php" method="post">
                <input type="text" name="usernameOrEmail" placeholder="Username or email">
                <input type="password" name="password" placeholder="Password">
                <br>
                <button type="submit" name="submit">Login</button>
            </form>
            <?php
        if (isset($_GET["reset"])){
            if ($_GET["reset"] == "success"){
                echo '<p>Check your e-mail!</p>';
            }
        }
             
            ?>
        </div>


    </section> 

    
</body>
</html>