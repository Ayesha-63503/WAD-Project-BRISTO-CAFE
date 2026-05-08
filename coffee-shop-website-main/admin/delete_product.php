<?php
session_start();
include '../config/db.php';

/* ADMIN CHECK */
if(!isset($_SESSION['admin'])) {
    die("Access Denied");
}

/* DELETE USING ID */
if(!isset($_GET['id'])) {
    die("Product ID missing");
}

$id = (int) $_GET['id'];

/* DELETE QUERY */
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

/* REDIRECT BACK */
header("Location: view_products.php");
exit();
?>