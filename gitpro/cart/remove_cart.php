<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "not logged in";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_id = $_POST['cart_id'];

mysqli_query($conn, "DELETE FROM cart WHERE cart_id=$cart_id AND user_id=$user_id");

echo "removed";
?>