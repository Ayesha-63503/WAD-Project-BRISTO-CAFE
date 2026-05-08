<?php
include '../config/db.php';

/* VALIDATE ID */
if(!isset($_GET['id'])) {
    die("Product ID is missing");
}

$id = (int) $_GET['id'];

/* FETCH PRODUCT */
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");

if(!$result || mysqli_num_rows($result) == 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($result);

/* UPDATE PRODUCT */
if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $product_code = $_POST['product_code'];

    if(!empty($_FILES['image']['name'])) {

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../assets/images/" . $image);

        $sql = "UPDATE products SET 
                name='$name',
                price='$price',
                category='$category',
                image='$image',
                product_code='$product_code'
                WHERE id=$id";

    } else {

        $sql = "UPDATE products SET 
                name='$name',
                price='$price',
                category='$category',
                product_code='$product_code'
                WHERE id=$id";
    }

    mysqli_query($conn, $sql);

    header("Location: view_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>

    <style>
        body{
            margin:0;
            font-family: Arial;
            background:#2c1b18;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .card{
            width:380px;
            background:#fff;
            padding:20px;
            border-radius:10px;
        }

        h2{
            text-align:center;
            margin-bottom:15px;
        }

        input, select{
            width:100%;
            padding:8px;
            margin:6px 0;
        }

        button{
            width:100%;
            padding:10px;
            background:green;
            color:white;
            border:none;
            margin-top:10px;
        }

        img{
            display:block;
            margin:10px auto;
            width:100px;
        }
    </style>
</head>

<body>

<div class="card">

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>">

    <label>Price</label>
    <input type="number" name="price" value="<?php echo $product['price']; ?>">

    <label>Category</label>
    <select name="category">
        <option value="coffee" <?php if($product['category']=='coffee') echo 'selected'; ?>>coffee</option>
        <option value="drinks" <?php if($product['category']=='drinks') echo 'selected'; ?>>drinks</option>
        <option value="pizza" <?php if($product['category']=='pizza') echo 'selected'; ?>>pizza</option>
        <option value="dessert" <?php if($product['category']=='dessert') echo 'selected'; ?>>dessert</option>
        <option value="sandwich" <?php if($product['category']=='sandwich') echo 'selected'; ?>>sandwich</option>
        <option value="pasta" <?php if($product['category']=='pasta') echo 'selected'; ?>>pasta</option>
    </select>

    <label>Product Code</label>
    <input type="text" name="product_code" value="<?php echo $product['product_code']; ?>">

    <label>Current Image</label>
    <img src="../assets/images/<?php echo $product['image']; ?>">

    <label>Change Image</label>
    <input type="file" name="image">

    <button type="submit" name="update">Update</button>

</form>

</div>

</body>
</html>