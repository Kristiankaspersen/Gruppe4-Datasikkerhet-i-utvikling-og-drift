<?php
$servername = "localhost";
$username = "fire_db_bruker";
$password = "NF@Ykpk7M8b3";

// Creating connection
$conn = mysqli_connect($servername, $username, $password);
// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DROP SCHEMA Gruppe4DB;";
if (mysqli_query($conn, $sql)) { 
    echo "Old DB dropped \n"; 
} else { 
    echo "There were no older DB to drop \n"; 
}


$sql = "CREATE SCHEMA IF NOT EXISTS `Gruppe4DB` DEFAULT CHARACTER SET utf8mb4;";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully with the name GruppeFireDB \n";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
 
// closing connection
mysqli_close($conn);

try {
    $conn = new PDO("mysql:host=$servername;dbname=Gruppe4DB", $username, $password);
    // setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $query = file_get_contents("Gruppe4DB.sql");
    $conn->exec($query);
    echo "Tables and all deafault data successfully inserted in the DB \n";
    }
catch(PDOException $e)
    {
    echo $query . "
" . $e->getMessage();
    }
$conn = null;


?>
