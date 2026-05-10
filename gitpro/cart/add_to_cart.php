<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "not logged in";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$check = "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id";
$result = mysqli_query($conn, $check);

if(mysqli_num_rows($result) > 0){
    $update = "UPDATE cart SET quantity = quantity + 1
               WHERE user_id=$user_id AND product_id=$product_id";
    mysqli_query($conn, $update);
} else {
    $insert = "INSERT INTO cart (user_id, product_id, quantity)
               VALUES ($user_id, $product_id, 1)";
    mysqli_query($conn, $insert);
}

echo "OK";
?>