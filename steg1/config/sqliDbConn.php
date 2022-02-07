<?php
$dBServername = "localhost:3307";
$dBUsername = "root";
$dBPassword = "root";
$dBName ="GruppeFireDB";


$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}
?>