<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {}
?>
<!DOCTYPE html>
<html>
<head>

    <title> Change Password</title>

</head>
<body>
    <h2 align="center"> Change Password</h2>
  <div>  <?php if(isset($message)) {echo $message;} ?> </div>
<form method="post" action="classes/C-Password.php" align="center">
Current Password:<br>
<input type="password" 
name="cpwd">
<span id="cpwd"></span>
<br>

New Password:<br>
<input type="password" 
name="npwd">
<span id="npwd" ></span>
<br>

Confirm Password:<br>
<input type="password" 
name="c_npwd">
<span id="c_npwd" ></span>
<br><br>
<input type="submit">
</form>

</body>

</html>