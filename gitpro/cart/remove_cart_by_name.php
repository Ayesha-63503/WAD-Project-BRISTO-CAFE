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

mysqli_query($conn, "DELETE FROM cart WHERE user_id=$user_id AND product_id=$product_id");

echo "removed";
?>