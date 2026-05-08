<?php
$conn = mysqli_connect("localhost:3307", "root", "", "Baristo");

if(!$conn){
    die("DB Connection Failed: " . mysqli_connect_error());
}
?>