<?php include '../config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #3b2f2f, #6f4e37);
}

.box {
    width: 350px;
    padding: 30px;
    background: #fffaf3;
    border-radius: 12px;
    text-align: center;
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
}

button {
    width: 100%;
    padding: 10px;
    background: #6f4e37;
    color: white;
    border: none;
}
</style>

</head>
<body>

<div class="box">

<h2>☕ Add Product</h2>

<form method="POST" action="insert_product.php" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Product Name" required>

    <input type="number" name="price" placeholder="Price" required>

    <!-- CATEGORY FIELD -->
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="coffee">Coffee</option>
        <option value="drinks">Drinks</option>
        <option value="pizza">Pizza</option>
        <option value="dessert">Dessert</option>
        <option value="sandwich">Sandwich</option>
        <option value="pasta">Pasta</option>
    </select>

    <!-- IMAGE -->
    <input type="file" name="image" required>

    <button type="submit">Save Product</button>

</form>

</div>

</body>
</html>