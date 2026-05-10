<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    die("Access Denied");
}

$error = "";

if (isset($_POST['search'])) {

    $id = (int) $_POST['product_id'];

    if ($id <= 0) {
        $error = "Please enter a valid Product ID";
    } else {

        $check = mysqli_query($conn,
            "SELECT product_id FROM products WHERE product_id = '$id'"
        );

        if (mysqli_num_rows($check) > 0) {

            header("Location: edit_product.php?id=" . urlencode($id));
            exit();

        } else {
            $error = "Product ID not found";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Find Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#111;
            color:white;
            font-family:Arial;
        }

        .box{
            width:450px;
            margin:100px auto;
            background:#1e1e1e;
            padding:35px;
            border-radius:15px;
            box-shadow:0 0 15px rgba(0,0,0,0.4);
        }

        .btn-custom{
            background:#ff9800;
            color:white;
            border:none;
        }

        .btn-custom:hover{
            background:#e68900;
        }

    </style>

</head>

<body>

<div class="box">

    <h2 class="text-center mb-4">
        Find Product
    </h2>

    <?php if($error != "") { ?>

        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">
                Enter Product ID
            </label>

            <input type="number"
                   name="product_id"
                   class="form-control"
                   placeholder="e.g. 26"
                   required>

        </div>

        <button type="submit"
                name="search"
                class="btn btn-custom w-100">

            Find Product

        </button>

    </form>

</div>

</body>
</html>