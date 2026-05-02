<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
session_start();
include "../config/db.php";

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        $_SESSION['admin'] = $user['role'];

        header("Location: products.php");

    } else {
        echo "Invalid login";
    }
}
?>