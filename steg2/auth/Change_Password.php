<?php 
session_start();

$user = $_SESSION['username'];

if ($user)
{
  if ($_POST['submit'])
  {
    $op = ($_POST['op']);
    $np = ($_POST['np']);
    $rp = ($_POST['rp']);

    $hashnp = password_hash($np, PASSWORD_DEFAULT); 
    $connect = mysqli_connect("localhost", "root", "", "GruppeFireDB") or die();
    $queryget = mysqli_query($connect, "SELECT password FROM user WHERE username = '$user'") or die("Not worky");
    $row = mysqli_fetch_assoc($queryget);
    $opdb = $row['password'];
    $faktisk_passord = password_hash($opdb, PASSWORD_DEFAULT);
    $checked_pwd = (password_verify($opdb , $faktisk_passord));


    if ($checked_pwd = true)
    {
      
      if ($np = $rp)
      {
        $sql = "UPDATE user SET password = '$hashnp' WHERE username = '$user' ";
        mysqli_query($connect, $sql);
      die("Your password has been changed!");
      }
      else 
        die("Passwords must match");
    }
    else 
      die("Old password doesnt match!");

  }
  echo"
    <form action='Change_Password.php' method='POST'>
        Old password: <input type='text' name='op'> <p>
        New password: <input type='password' name='np'> <br>
        Repeat new password: <input type='password' name='rp'> <p>
        <input type='submit' name='submit' value='Change_password'>
        </form>
";
}
else
  die("Log in.")
?>