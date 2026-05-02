<?php
include "../config/db.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    mysqli_query($conn, "UPDATE products SET name='$name', price='$price' WHERE id=$id");
    header("Location: dashboard.php");
}
?>

<form method="POST">
    <input type="text" name="name" value="<?php echo $row['name']; ?>">
    <input type="number" name="price" value="<?php echo $row['price']; ?>">
    <button>Update</button>
</form>