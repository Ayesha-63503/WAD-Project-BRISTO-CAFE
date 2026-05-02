

//cart.php
<?php
include 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

$currentDate = date('Y-m-d');

$stmt = $conn->prepare("INSERT INTO cart (title, price, quantity, total, date_created) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

foreach ($data as $item) {

    $title = $item["title"] ?? '';
    $price = $item["price"] ?? 0;
    $quantity = $item["quantity"] ?? 1;
    $total = $item["total"] ?? ($price * $quantity);

    $stmt->bind_param("sdiis", $title, $price, $quantity, $total, $currentDate);

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
        exit;
    }
}

echo json_encode(["status" => "success", "message" => "Cart saved"]);

$stmt->close();
$conn->close();
?>