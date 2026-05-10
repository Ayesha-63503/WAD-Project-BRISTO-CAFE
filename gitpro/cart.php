<?php
include '../config/db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

$currentDate = date('Y-m-d');

$stmt = $conn->prepare("
    INSERT INTO cart (title, price, quantity, total, date_created)
    VALUES (?, ?, ?, ?, ?)
");

foreach ($data as $item) {

    $title = $item["name"];
    $price = (float)$item["price"];
    $quantity = $item["qty"] ?? 1;
    $total = $price * $quantity;

    $stmt->bind_param("sdids", $title, $price, $quantity, $total, $currentDate);
    $stmt->execute();
}

echo json_encode(["status" => "success", "message" => "Cart saved"]);

$stmt->close();
$conn->close();
?>