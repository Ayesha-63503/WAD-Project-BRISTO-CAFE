<?php
include '../config/db.php';

// READ products
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id ASC");

if(!$result){
    die(mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Products</title>

<style>
body{
    margin:0;
    font-family: Arial;
    background:#2c1b18;
    padding:20px;
    color:white;
}

h2{
    text-align:center;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    color:black;
    border-radius:10px;
    overflow:hidden;
}

th, td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

th{
    background:#6f4e37;
    color:white;
}

img{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:6px;
}

.action a{
    padding:5px 10px;
    text-decoration:none;
    color:white;
    border-radius:5px;
    margin:2px;
}

.delete{
    background:red;
}

.edit{
    background:green;
}
</style>
</head>

<body>

<h2>📦 Admin - All Products</h2>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
    <th>Image</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>Rs <?php echo $row['price']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td>
        <img src="../assets/images/<?php echo $row['image']; ?>">
    </td>

   <td>
    <!-- EDIT BUTTON -->
    <a href="edit_product.php?id=<?php echo $row['id']; ?>" 
       style="background:green; color:white; padding:5px 10px; text-decoration:none; border-radius:5px; margin-right:8px;">
        Edit
    </a>

    <!-- DELETE BUTTON -->
    <a href="delete_product.php?id=<?php echo $row['id']; ?>" 
       style="background:red; color:white; padding:5px 10px; text-decoration:none; border-radius:5px;"
       onclick="return confirm('Delete this product?');">
        Delete
    </a>
</td>
</tr>

<?php } ?>

</table>

</body>
</html>