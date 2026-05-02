<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/* ADD */
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    mysqli_query($conn, "INSERT INTO products (name, price) VALUES ('$name','$price')");
}

/* DELETE */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

/* UPDATE */
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    mysqli_query($conn, "UPDATE products SET name='$name', price='$price' WHERE id=$id");
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body {
    background: #000;
    font-family: 'Poppins', sans-serif;
    color: #fff;
    padding: 30px;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

.form-box {
    background: #111;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    text-align: center;
}

.form-box input {
    padding: 10px;
    margin: 5px;
    border-radius: 6px;
    border: none;
    background: #222;
    color: white;
}

.form-box button {
    padding: 10px 20px;
    background: #9F5C44;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}

.form-box button:hover {
    background: #7a4433;
}

.product {
    background: #111;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product input {
    padding: 6px;
    border-radius: 6px;
    border: none;
    background: #222;
    color: white;
}

.product button {
    padding: 6px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.update-btn {
    background: #9F5C44;
    color: white;
}

.delete-btn {
    background: red;
    color: white;
}
</style>

</head>

<body>

<h1>Admin Dashboard</h1>

<div class="form-box">
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <button name="add">Add Product</button>
    </form>
</div>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<div class="product">
    
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="name" value="<?php echo $row['name']; ?>">
        <input type="number" name="price" value="<?php echo $row['price']; ?>">
        <button class="update-btn" name="update">Update</button>
    </form>

    <a href="?delete=<?php echo $row['id']; ?>">
        <button class="delete-btn">Delete</button>
    </a>

</div>
<?php } ?>

</body>
</html>