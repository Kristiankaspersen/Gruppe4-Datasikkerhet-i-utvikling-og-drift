<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Steg1-Gruppe4</title>
</head>
<body>
<?php
// Change for server
$servername = "localhost:3308";
$username = "root";
$password = "root";
$dbName = "GruppeFireDB";

$mysqli = new mysqli($servername, $username, $password, $dbName); 
$query = "SELECT course_id, course_name FROM course";

echo $_GET['course'];
?>
<h2><a href=""></a></h2>
</body>
</html>