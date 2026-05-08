<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['admin'])) {
    die("Access Denied");
}

$error = "";

if(isset($_POST['search'])) {

    $code = $_POST['product_code'];

    $result = mysqli_query($conn, "SELECT id FROM products WHERE product_code='$code'");

    if(mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        // redirect to edit page with ID
        header("Location: edit_product.php?id=" . $row['id']);
        exit();

    } else {
        $error = "Invalid Product Code";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Find Product</title>


<style>
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #2c1b18, #6f4e37);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* card box */
.box {
    background: #fffaf3;
    padding: 30px;
    width: 350px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    animation: fadeIn 0.5s ease;
}

/* heading */
.box h2 {
    color: #5a3e2b;
    margin-bottom: 15px;
}

/* input */
input {
    width: 100%;
    padding: 10px;
    margin: 12px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    transition: 0.3s;
}

input:focus {
    border-color: #6f4e37;
    box-shadow: 0 0 5px rgba(111,78,55,0.5);
}

/* button */
button {
    width: 100%;
    padding: 10px;
    background: #6f4e37;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #5a3e2b;
    transform: scale(1.03);
}

/* error */
.err {
    margin-top: 10px;
    color: red;
}

/* animation (NOW CORRECTLY INSIDE STYLE) */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>
</head>

<body>

<div class="box">

<h2>Enter Product Code</h2>

<form method="POST">

    <input type="text" name="product_code" placeholder="e.g. COF001" required>

    <button type="submit" name="search">Find & Edit</button>

</form>

<?php if($error) echo "<div class='err'>$error</div>"; ?>

</div>

</body>
</html>