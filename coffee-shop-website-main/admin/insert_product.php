<?php
//insert_product.php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];

$imageName = $_FILES['image']['name'];
$tempName = $_FILES['image']['tmp_name'];

$targetFolder = "../images/" . $imageName;
move_uploaded_file($tempName, $targetFolder);

// generate product code
$product_code = "PRD-" . rand(10000, 99999);

$sql = "INSERT INTO products (name, price, category, image, product_code)
        VALUES ('$name', '$price', '$category', '$imageName', '$product_code')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Product Added Successfully');
            window.location.href='add_product.php';
          </script>";
} else {
    die(mysqli_error($conn));
}
}
?>