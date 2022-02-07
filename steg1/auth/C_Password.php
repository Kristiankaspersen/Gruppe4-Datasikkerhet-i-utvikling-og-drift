<?php 
session_start();

if (isset($_SESSION['student_id']) || isset($_SESSION["lecture_id"]) && isset($_SESSION['username'])) 
{

$user_id = $_SESSION["student_id"];
include "../config/DatabaseConnection.php";

 $database = new DatabaseConnection();
 $conn = $database->connect();

  if (isset($_POST["Change_Password"]))
  {
    $current_pwd = $_POST("op");
    $new_pwd = $_POST("np");
    $confirm_pwd = $_POST("c_np");

    $sql = " SELECT password FROM user WHERE student_id = '" . $user_id . "'";
    $passwordHashed = $statement->fetchAll(PDO::FETCH_ASSOC);
    $hashed_Password = $passwordHashed[0]["password"];
    $hash_np = password_hash($new_pwd, PASSWORD_DEFAULT);
    echo $new_pwd;
    print_r("test");

   if (password_verify($new_pwd, $hashed_Password))
    {
        if ($new_pwd == $confirm_pwd)
        $sql2 = " UPDATE user SET password = $hash_np  WHERE student_id = '" . $user_id . "'";
        $statement = $conn->connect()->prepare($sql2);
        $statement = $conn->execute();

        $message = "Password changed.";
       // header("Location: change-password.php?success=Your password has been changed successfully");
      }
      else
      {
        $message = "Password does not match.";
       // header("Location: change-password.php?error=The confirmation password  does not match");
      }

    }
    else
    {
      $message = "Password incorrect.";
     // header("Location: change-password.php?error=Old Password is incorrect");
    }
}
?>