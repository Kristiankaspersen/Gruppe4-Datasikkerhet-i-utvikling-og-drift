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
<h2><a href="../steg1/index.php">Gå tilbake</a></h2>

<h1>Skriv inn pin kode for ønsket fag</h1>
<form action="course.php" method="post">
<input type="number" name="pin_code"><br>
<input type="submit">
</form>
<h1>Fag</h1>

<?php

include "config/mysqliConn.php"; 
// $query = "SELECT course_id, course_name FROM course";

echo "
<table>
<tr>
<td>Kurskode</td>
<td>Kursnavn</td>
</tr>
";

$stmt = $mysqli->prepare("SELECT course_id, course_name FROM course");
$stmt->execute();

if ($result = $stmt->get_result()){
    while(($row = $result->fetch_assoc())){
        $courseId = $row["course_id"];
        $courseName = $row["course_name"];
        
        echo "
        <tr>
        <td><a href='course.php?course=".$courseId."'>" .$courseId. "</a></td>
            <td>" .$courseName. "</td>
        </tr>";
        
    }    
    $result->free();    
}
    
?>
</body>
</html>