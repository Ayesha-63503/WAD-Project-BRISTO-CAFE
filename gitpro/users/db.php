<?php
$conn = mysqli_connect("localhost:3307", "root", "", "Baresto");

if(!$conn){
    die("DB Connection Failed: " . mysqli_connect_error());
}
?>