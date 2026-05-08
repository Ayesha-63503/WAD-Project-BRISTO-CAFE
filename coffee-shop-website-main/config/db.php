<?php
$host = "localhost:3307";
$username = "root";
$password = "";
$database = "Baresto";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed");
}
?>