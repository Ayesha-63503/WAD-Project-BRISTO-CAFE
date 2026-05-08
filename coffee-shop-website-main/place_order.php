<?php
include "config/db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['cart'])) {
    echo json_encode(["status"=>"error","message"=>"Cart empty"]);
    exit;
}

$cart = $data['cart'];

$name = $data['user']['name'] ?? '';
$phone = $data['user']['phone'] ?? '';
$address = $data['user']['address'] ?? '';

$total = 0;

foreach ($cart as $item) {
    $price = $item['price'] ?? 0;
    $qty = $item['quantity'] ?? 1;
    $total += $price * $qty;
}

$stmt = $conn->prepare("
    INSERT INTO orders (total_price, order_date, name, phone, address)
    VALUES (?, NOW(), ?, ?, ?)
");

$stmt->bind_param("isss", $total, $name, $phone, $address);
$stmt->execute();

$order_id = $stmt->insert_id;

$itemStmt = $conn->prepare("
    INSERT INTO order_items (order_id, product_name, price, quantity)
    VALUES (?, ?, ?, ?)
");

foreach ($cart as $item) {

    $product_name = $item['title'] ?? 'Item';
    $price = $item['price'] ?? 0;
    $qty = $item['quantity'] ?? 1;

    $itemStmt->bind_param("isii", $order_id, $product_name, $price, $qty);
    $itemStmt->execute();
}

echo json_encode([
    "status"=>"success",
    "message"=>"Order placed successfully"
]);