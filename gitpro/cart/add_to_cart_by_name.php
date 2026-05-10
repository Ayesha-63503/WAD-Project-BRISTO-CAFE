<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "not logged in";
    exit;
}

$user_id = $_SESSION['user_id'];
$name    = mysqli_real_escape_string($conn, $_POST['name']);

$product_query = "SELECT product_id FROM products WHERE name='$name' LIMIT 1";
$product_result = mysqli_query($conn, $product_query);

if (!$product_result || mysqli_num_rows($product_result) == 0) {
    echo "product not found";
    exit;
}

$product_row = mysqli_fetch_assoc($product_result);
$product_id  = $product_row['product_id'];

$check = "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id";
$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) > 0) {
    mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1
                         WHERE user_id=$user_id AND product_id=$product_id");
} else {
    mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity)
                         VALUES ($user_id, $product_id, 1)");
}

echo "OK";
?>