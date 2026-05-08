<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #2c1b18, #6f4e37);
}

/* top bar */
.header {
    background: #3b2f2f;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 22px;
}

/* container */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

/* card grid */
.grid {
    display: grid;
    grid-template-columns: repeat(2, 200px);
    gap: 20px;
}

/* cards */
.card {
    background: #fffaf3;
    padding: 30px;
    text-align: center;
    border-radius: 12px;
    text-decoration: none;
    color: #5a3e2b;
    font-weight: bold;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    transition: 0.3s;
}

.card:hover {
    transform: scale(1.05);
    background: #f3e5d8;
}
</style>

</head>

<body>

<div class="header">
    ☕ Coffee Shop Admin Dashboard
</div>

<div class="container">

    <div class="grid">

        <a class="card" href="add_product.php">
            ➕ Add Product
        </a>

        <a class="card" href="view_products.php">
            📦 View Products
        </a>

        <a class="card" href="find_product.php">
            ✏️ Edit Product
        </a>

        <a class="card" href="delete_product.php">
            ❌ Delete Product
        </a>

    </div>

</div>

</body>
</html>