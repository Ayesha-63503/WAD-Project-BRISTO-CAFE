<?php
// No output before this line — not even a blank line or space above <?php
include "config/db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['cart']) || count($data['cart']) == 0) {
    echo json_encode(["status" => "error", "message" => "Cart is empty"]);
    exit;
}

$cart    = $data['cart'];
$name    = isset($data['user']['name'])    ? $data['user']['name']    : '';
$phone   = isset($data['user']['phone'])   ? $data['user']['phone']   : '';
$address = isset($data['user']['address']) ? $data['user']['address'] : '';

// Calculate total
$total = 0;
foreach ($cart as $item) {
    $price = isset($item['price']) ? floatval($item['price']) : 0;
    $qty   = isset($item['quantity']) ? intval($item['quantity']) : 1;
    $total += $price * $qty;
}

// Insert into orders table
$stmt = mysqli_prepare($conn, "INSERT INTO orders (total_price, order_date, name, phone, address) VALUES (?, NOW(), ?, ?, ?)");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "DB prepare failed: " . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt, "dsss", $total, $name, $phone, $address);
mysqli_stmt_execute($stmt);
$order_id = mysqli_insert_id($conn);

// Insert each cart item into order_items
$itemStmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_name, price, quantity) VALUES (?, ?, ?, ?)");

if (!$itemStmt) {
    echo json_encode(["status" => "error", "message" => "DB prepare failed: " . mysqli_error($conn)]);
    exit;
}

foreach ($cart as $item) {
    // cart.js stores name as 'name' key — fix from original 'title' bug
    $product_name = isset($item['name'])  ? $item['name']  : 
                   (isset($item['title']) ? $item['title'] : 'Item');
    $price        = isset($item['price']) ? floatval($item['price']) : 0;
    $qty          = isset($item['quantity']) ? intval($item['quantity']) : 1;

    mysqli_stmt_bind_param($itemStmt, "isdi", $order_id, $product_name, $price, $qty);
    mysqli_stmt_execute($itemStmt);
}

echo json_encode(["status" => "success", "message" => "Order placed successfully"]);
?>