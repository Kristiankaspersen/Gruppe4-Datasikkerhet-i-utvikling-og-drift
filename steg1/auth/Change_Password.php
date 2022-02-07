<?php 
session_start();

if (isset($_SESSION['student_id']) || isset($_SESSION["lecture_id"]) && isset($_SESSION['username'])) 
{

 ?>
<!DOCTYPE html>
<html>
<head>

    <title> Change Password</title>

</head>
<body>
    <h2 align="center"> Change Password</h2>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
<form method="post" action="C_Password.php" align="center">
Current Password:<br>
<input type="password" 
name="op">
<span id="op"></span>
<br>

New Password:<br>
<input type="password" 
name="np">
<span id="np" ></span>
<br>

Confirm Password:<br>
<input type="password" 
name="c_np">
<span id="c_np" ></span>
<br><br>
<input type="submit">
<br>
<a href="index.php" class="ca">HOME</a>
</form>

</body>

</html>
<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>