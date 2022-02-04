<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) 
{

$user_id = $_SESSION["id"];
 include "config/DatabaseConnection.php";

 $database = new DatabaseConnection();
 $conn = $database->connect();

  if (isset($_POST["Change_Password"]))
  {
    $current_pwd = $_POST("cpwd");
    $new_pwd = $_POST("npwd");
    $confirm_pwd = $_POST("c_npwd");

    $sql = " SELECT password FROM user WHERE id = '" . $user_id . "'";
    $passwordHashed = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (password_verify($current_pwd, $passwordHashed[0]["password"])
    {
        if ($new_pwd == $confirm_pwd)
      {
        $sql = "UPDATE user SET password = '" . password_hash($new_pwd, PASSWORD_DEFAULT) . "' WHERE id = '" . $user_id . "'";
        $statement = $conn->connect()->prepare($sql);
        $statement = $conn->execute();

        $message = "Password changed.";
      }
      else
      {
        $message = "Password does not match.";
      }

    }
    else
    {
      $message = "Password incorrect.";
    }
}
}

?>