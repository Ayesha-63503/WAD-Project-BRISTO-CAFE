<?php
session_start();
include "config/db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['cart']) || count($data['cart']) == 0) {
    echo json_encode(["status" => "error", "message" => "Cart is empty"]);
    exit;
}

$cart       = $data['cart'];
$customer_name = $data['user']['name'] ?? '';
$phone      = $data['user']['phone'] ?? '';
$address    = $data['user']['address'] ?? '';
$user_id    = $_SESSION['user_id'] ?? null;
$status     = 'pending';

// Calculate total
$total_amount = 0;
foreach ($cart as $item) {
    $price = $item['price'] ?? 0;
    $qty   = $item['qty'] ?? $item['quantity'] ?? 1;
    $total_amount += $price * $qty;
}

// Insert into orders — matching your actual columns:
// order_id, user_id, customer_name, phone, address, total_amount, status, order_date
$stmt = $conn->prepare("
    INSERT INTO orders (user_id, customer_name, phone, address, total_amount, status, order_date)
    VALUES (?, ?, ?, ?, ?, ?, NOW())
");

$stmt->bind_param("isssds", $user_id, $customer_name, $phone, $address, $total_amount, $status);

if (!$stmt->execute()) {
    echo json_encode(["status" => "error", "message" => "Order failed: " . $stmt->error]);
    exit;
}

$order_id = $stmt->insert_id;

// Insert into order_items — matching your actual columns:
// order_item_id, order_id, product_name, quantity, price, total
$itemStmt = $conn->prepare("
    INSERT INTO order_items (order_id, product_name, quantity, price, total)
    VALUES (?, ?, ?, ?, ?)
");

foreach ($cart as $item) {
    $product_name = $item['name'] ?? 'Item';
    $price        = $item['price'] ?? 0;
    $qty          = $item['qty'] ?? $item['quantity'] ?? 1;
    $total        = $price * $qty;

    $itemStmt->bind_param("isidd", $order_id, $product_name, $qty, $price, $total);

    if (!$itemStmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Item insert failed: " . $itemStmt->error]);
        exit;
    }
}
// Clear the cart from DB after order
if ($user_id) {
    $clearStmt = $conn->prepare(
        "DELETE FROM cart WHERE user_id = ?"
    );
    $clearStmt->bind_param("i", $user_id);
    $clearStmt->execute();
}
echo json_encode([
    "status"  => "success",
    "message" => "Order placed successfully"
]);