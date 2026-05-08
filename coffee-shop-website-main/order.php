<?php
include "db.php";

header("Content-Type: application/json");

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['cart'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Cart is empty"
    ]);
    exit;
}

$cart = $data['cart'];

// Convert cart to JSON string
$orderItems = json_encode($cart);

// Calculate total
$total = 0;
foreach ($cart as $item) {
    $qty = isset($item['quantity']) ? $item['quantity'] : 1;
    $total += $item['price'] * $qty;
}

// Insert into DB
$sql = "INSERT INTO orders (items, total, status) 
        VALUES ('$orderItems', '$total', 'Pending')";

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        "status" => "success",
        "message" => "Order placed successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
?>