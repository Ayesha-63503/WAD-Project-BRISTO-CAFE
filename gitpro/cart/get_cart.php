<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT c.quantity, p.name, p.price
          FROM cart c
          JOIN products p ON c.product_id = p.product_id
          WHERE c.user_id = $user_id";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode([]);
    exit;
}

$cart = [];
while($row = mysqli_fetch_assoc($result)){
    $cart[] = $row;
}

echo json_encode($cart);
?>