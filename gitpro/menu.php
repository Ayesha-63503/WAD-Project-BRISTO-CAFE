<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: /gitpro/users/login.php");
    exit();
}
include 'config/db.php';
$hide_navbar = true;

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu - Baresto</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Great+Vibes&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Header styles -->
<link rel="stylesheet" href="assets/css/header.css">

<!-- Menu page styles -->
<link rel="stylesheet" href="assets/css/menu.css">

</head>

<body class="menu-page">
<div id="toast" class="toast"></div>

<?php include 'header.php'; ?> 

<div class="container py-4">

    <!-- TOP CART BAR -->
    <div id="top-cart" class="top-cart">
        <div class="cart-left">
            <h4>🛒 Your Cart</h4>
            <div id="cart-items-mini"></div>
            <h4 id="menu-total" style="display:none;">Total: Rs 0</h4>
        </div>
        <div class="cart-right">
            <button onclick="checkout()" class="checkout-btn">Checkout</button>
        </div>
    </div>

    <h1 class="text-center text-white">Our Menu ☕</h1>

    <!-- CATEGORY BUTTONS -->
    <div class="filter-btns">
        <button onclick="filterMenu('all')">All</button>
        <button onclick="filterMenu('coffee')">Coffee</button>
        <button onclick="filterMenu('drinks')">Drinks</button>
        <button onclick="filterMenu('pizza')">Pizza</button>
        <button onclick="filterMenu('dessert')">Dessert</button>
        <button onclick="filterMenu('sandwich')">Sandwiches</button>
        <button onclick="filterMenu('pasta')">Pastas</button>
    </div>

    <!-- MENU ITEMS — FROM DATABASE ONLY -->
    <div class="row g-4">

    <?php
    if($search != ""){
        $query = "SELECT * FROM products WHERE name LIKE '%$search%' ORDER BY 
                  CASE category
                      WHEN 'coffee' THEN 1
                      WHEN 'drinks' THEN 2
                      WHEN 'pizza' THEN 3
                      WHEN 'dessert' THEN 4
                      WHEN 'sandwich' THEN 5
                      WHEN 'pasta' THEN 6
                      ELSE 7
                  END, product_id ASC";
    } else {
        $query = "SELECT * FROM products ORDER BY 
                  CASE category
                      WHEN 'coffee' THEN 1
                      WHEN 'drinks' THEN 2
                      WHEN 'pizza' THEN 3
                      WHEN 'dessert' THEN 4
                      WHEN 'sandwich' THEN 5
                      WHEN 'pasta' THEN 6
                      ELSE 7
                  END, product_id ASC";
    }

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    while($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="col-md-3 menu-item <?php echo strtolower($row['category']); ?>">
            <div class="card menu-card">
                <img src="assets/images/<?php echo $row['image']; ?>" class="menu-img">
                <div class="card-body">
                    <h5><?php echo $row['name']; ?></h5>
                    <p>Rs <?php echo $row['price']; ?></p>
                    <button class="add-to-cart"
                        onclick="addToCart('<?php echo $row['name']; ?>', <?php echo $row['price']; ?>)">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    <?php } ?>

    </div>
</div>

<script>
function filterMenu(category) {

    const items = Array.from(document.querySelectorAll('.menu-item'));
    const container = document.querySelector('.row');
    const order = ['coffee', 'drinks', 'pizza', 'dessert', 'sandwich', 'pasta'];

    if (category === 'all') {
        items.forEach(i => i.style.display = 'none');
        order.forEach(cat => {
            items
                .filter(item => item.classList.contains(cat))
                .forEach(item => {
                    item.style.display = 'flex';
                    container.appendChild(item);
                });
        });
    } else {
        items.forEach(item => {
            item.style.display = item.classList.contains(category) ? 'flex' : 'none';
        });
    }
}

function getCategory(item) {
    let classes = item.classList;
    if (classes.contains('coffee')) return 'coffee';
    if (classes.contains('drinks')) return 'drinks';
    if (classes.contains('pizza')) return 'pizza';
    if (classes.contains('dessert')) return 'dessert';
    if (classes.contains('sandwich')) return 'sandwich';
    if (classes.contains('pasta')) return 'pasta';
    return 'unknown';
}

document.addEventListener("DOMContentLoaded", syncCartUI);
</script>

</body>
</html>