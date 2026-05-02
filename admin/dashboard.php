<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<h2>Admin Dashboard</h2>

<a href="add_product.php">➕ Add Product</a>
<br><br>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div>
        <h3><?php echo $row['name']; ?></h3>
        <p>Rs <?php echo $row['price']; ?></p>

        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
    </div>
<?php } ?>