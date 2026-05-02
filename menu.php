<?php
include "config/db.php";
?>

<!DOCTYPE html>
<html lang="en"> //menu.php
<head>
<meta charset="UTF-8">
<title>Menu</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/menu.css">
</head>

<body>

<div class="container py-4">
    <!-- TOP CART BAR -->
<div id="top-cart" class="top-cart">

    <div class="cart-left">
        <h4>🛒 Your Cart</h4>
        <div id="cart-items-mini"></div>
        <h4 id="menu-total" style="display:none;">Total: Rs 0</h4>
    </div>

    <div class="cart-right">
    <button onclick="checkout()" class="checkout-btn">
    Checkout
</button>
</div>

<h4 id="menu-total" class="menu-total hidden"></h4>
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

<!-- MENU ITEMS -->
<div class="row g-4">

<?php
$result = mysqli_query($conn, "SELECT * FROM products");

while($row = mysqli_fetch_assoc($result)) {
?>
    
    <div class="col-md-3 menu-item">
        <div class="card menu-card">

            <img src="assets/images/default.jpg" class="menu-img">

            <div class="card-body">

                <h5><?php echo $row['name']; ?></h5>
                <p>Rs <?php echo $row['price']; ?></p>

                <button class="add-to-cart"
                    onclick="addToCart(
                        <?php echo $row['id']; ?>,
                        '<?php echo $row['name']; ?>',
                        <?php echo $row['price']; ?>
                    )">
                    Add to Cart
                </button>

            </div>
        </div>
    </div>

<?php } ?>

</div>

    <!-- COFFEE -->
    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/latte.jpg" class="menu-img">
            <div class="card-body">
                <h5>Latte</h5>
                <p>Rs 670</p>
                <button class="add-to-cart" onclick="addToCart('Latte', 670)">Add to Cart</button>
            </div>
        </div>
    </div>

    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/espresso.webp" class="menu-img">
            <div class="card-body">
                <h5>Espresso</h5>
                <p>Rs 450</p>
                <button class="add-to-cart" onclick="addToCart('Espresso', 450)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/cappucino.png" class="menu-img">
            <div class="card-body">
                <h5>Cappuccino</h5>
                <p>Rs 1670</p>
                <button class="add-to-cart" onclick="addToCart('Cappuccino', 1670)">Add to Cart</button>

            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/mocha.avif" class="menu-img">
            <div class="card-body">
                <h5>Mocha</h5>
                <p>Rs 1240</p>
                <button class="add-to-cart" onclick="addToCart('Mocha', 1240)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/macchiato.jpg" class="menu-img">
            <div class="card-body">
                <h5>Macchiato</h5>
                <p>Rs 1500</p>
                <button class="add-to-cart" onclick="addToCart('Macchiato', 1500)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/americano.webp" class="menu-img">
            <div class="card-body">
                <h5>Americano</h5>
                <p>Rs 250</p>
                <button class="add-to-cart" onclick="addToCart('Americano', 250)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item coffee">
        <div class="card menu-card">
            <img src="assets/images/cold-coffee.jpg" class="menu-img">
            <div class="card-body">
                <h5>Cold-Coffee</h5>
                <p>Rs 500</p>
                <button class="add-to-cart" onclick="addToCart('Cold-coffee', 500)">Add to Cart</button>
            </div>
        </div>
    </div>

    <!-- DRINKS -->
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/pina.jpg" class="menu-img">
            <div class="card-body">
                <h5>Pina colada</h5>
                <p>Rs 490</p>
                <button class="add-to-cart" onclick="addToCart('Pina colada', 490)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/mint.jpg" class="menu-img">
            <div class="card-body">
                <h5>Mint Margarita</h5>
                <p>Rs 999</p>
                <button class="add-to-cart"onclick="addToCart('Mint Margarita', 999)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/lemon.jpg" class="menu-img">
            <div class="card-body">
                <h5>Lemon ade</h5>
                <p>Rs 398</p>
                <button class="add-to-cart"onclick="addToCart('Lemon ade', 398)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/watermelon.jpg" class="menu-img">
            <div class="card-body">
                <h5>Water melon drink</h5>
                <p>Rs 576</p>
                <button class="add-to-cart"onclick="addToCart('Water melon drink', 576)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/cock.png" class="menu-img">
            <div class="card-body">
                <h5>Cocktail</h5>
                <p>Rs 3270</p>
                <button class="add-to-cart" onclick="addToCart('Cocktail',3270)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/bubble.jpg" class="menu-img">
            <div class="card-body">
                <h5>Bubble drink</h5>
                <p>Rs 2200</p>
                <button class="add-to-cart" onclick="addToCart('Bubble drink', 2200)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item drinks">
        <div class="card menu-card">
            <img src="assets/images/candy.jpg" class="menu-img">
            <div class="card-body">
                <h5>Candy Juice</h5>
                <p>Rs 850</p>
                <button class="add-to-cart" onclick="addToCart('Candy Juice',850)">Add to Cart</button>
            </div>
        </div>
    </div>


    <!-- PIZZA -->
    <div class="col-md-3 menu-item pizza">
        <div class="card menu-card">
            <img src="assets/images/tikka.avif" class="menu-img">
            <div class="card-body">
                <h5>Chicken Tikka Pizza</h5>
                <p>Rs 2200</p>
                <button class="add-to-cart" onclick="addToCart('Chicken Ttikka Pizza', 2200)">Add to Cart</button>
                
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item pizza">
        <div class="card menu-card">
            <img src="assets/images/malai.jpg" class="menu-img">
            <div class="card-body">
                <h5>chicken malai boti Pizza</h5>
                <p>Rs 3200</p>
                <button class="add-to-cart" onclick="addToCart('Chicken malai boti pizza', 3200)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item pizza">
        <div class="card menu-card">
            <img src="assets/images/pepp.webp" class="menu-img">
            <div class="card-body">
                <h5>Cheese Pizza</h5>
                <p>Rs 1590</p>
                <button class="add-to-cart" onclick="addToCart('Cheese pizza', 1590)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item pizza">
        <div class="card menu-card">
            <img src="assets/images/kaba.jpg" class="menu-img">
            <div class="card-body">
                <h5>Chicken kabab Pizza</h5>
                <p>Rs 4360</p>
                <button class="add-to-cart" onclick="addToCart('Chicken kabab Pizza', 4360)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item pizza">
        <div class="card menu-card">
            <img src="assets/images/chee.png" class="menu-img">
            <div class="card-body">
                <h5>Chicken Cheese Pizza</h5>
                <p>Rs 3000</p>
                <button class="add-to-cart" onclick="addToCart('Chicken cheese pizza', 3000)">Add to Cart</button>
            </div>
        </div>
    </div>

    <!-- DESSERT -->
    <div class="col-md-3 menu-item dessert">
        <div class="card menu-card">
            <img src="assets/images/tuttycake.jpg" class="menu-img">
            <div class="card-body">
                <h5>Tutty Fruity Cake</h5>
                <p>Rs 1460</p>
                <button class="add-to-cart" onclick="addToCart('Tutty fruity cake', 1460)">Add to Cart</button>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 menu-item dessert">
        <div class="card menu-card">
            <img src="assets/images/velvet.jpg" class="menu-img">
            <div class="card-body">
                <h5>Red velvet Cake</h5>
                <p>Rs 3400</p>
                <button class="add-to-cart" onclick="addToCart('Red velvet cake', 3400)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item dessert">
        <div class="card menu-card">
            <img src="assets/images/pine.jpg" class="menu-img">
            <div class="card-body">
                <h5>Pine Apple Cake</h5>
                <p>Rs 1300</p>
                <button class="add-to-cart"onclick="addToCart('pine apple cake', 1300)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item dessert">
        <div class="card menu-card">
            <img src="assets/images/almond.jpg" class="menu-img">
            <div class="card-body">
                <h5>Almond Cake</h5>
                <p>Rs 1200</p>
                <button class="add-to-cart"onclick="addToCart('Almond cake', 1200)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 menu-item dessert">
        <div class="card menu-card">
            <img src="assets/images/nut.webp" class="menu-img">
            <div class="card-body">
                <h5>Chocolate Nut Cake</h5>
                <p>Rs 4690</p>
                <button class="add-to-cart"onclick="addToCart('Chocolate nut cake', 4690)">Add to Cart</button>
            </div>
        </div>
    </div>
    <!-- SANDWICHES -->

<div class="col-md-3 menu-item sandwich">
    <div class="card menu-card">
        <img src="assets/images/chicken.jpg" class="menu-img">
        <div class="card-body">
            <h5>Chicken Sandwich</h5>
            <p>Rs 750</p>
            <button class="add-to-cart"onclick="addToCart('Chicken sandwich', 750)">Add to Cart</button>
        </div>
    </div>
</div>

<div class="col-md-3 menu-item sandwich">
    <div class="card menu-card">
        <img src="assets/images/beef.jpg" class="menu-img">
        <div class="card-body">
            <h5>Beef Sandwich</h5>
            <p>Rs 900</p>
            <button class="add-to-cart"onclick="addToCart('beef sandwich ', 900)">Add to Cart</button>
        </div>
    </div>
</div>

<div class="col-md-3 menu-item sandwich">
    <div class="card menu-card">
        <img src="assets/images/cheesand.jpg" class="menu-img">
        <div class="card-body">
            <h5>Cheese Club Sandwich</h5>
            <p>Rs 1100</p>
            <button class="add-to-cart"onclick="addToCart('Cheese Club sandwich', 1100)">Add to Cart</button>
        </div>
    </div>
</div>
<div class="col-md-3 menu-item sandwich">
    <div class="card menu-card">
        <img src="assets/images/grill.jpg" class="menu-img">
        <div class="card-body">
            <h5>Grill Chicken Sandwich</h5>
            <p>Rs 1700</p>
            <button class="add-to-cart"onclick="addToCart('Grill chicken sandwich ', 1700)">Add to Cart</button>
        </div>
    </div>
</div>
<!-- PASTA -->
<div class="col-md-3 menu-item pasta">
    <div class="card menu-card">
        <img src="assets/images/fredo.jpg" class="menu-img">
        <div class="card-body">
            <h5>Chicken Alfredo Pasta</h5>
            <p>Rs 1200</p>
            <button class="add-to-cart"onclick="addToCart('Chicken alfredo pasta', 1200)">Add to Cart</button>
        </div>
    </div>
</div>

<div class="col-md-3 menu-item pasta">
    <div class="card menu-card">
        <img src="assets/images/vegpa.jpg" class="menu-img">
        <div class="card-body">
            <h5>Veg Pasta</h5>
            <p>Rs 800</p>
            <button class="add-to-cart"onclick="addToCart('veg pasta', 800)">Add to Cart</button>
        </div>
    </div>
</div>

<div class="col-md-3 menu-item pasta">
    <div class="card menu-card">
        <img src="assets/images/whitesau.jpg" class="menu-img">
        <div class="card-body">
            <h5>White Sauce Pasta</h5>
            <p>Rs 1100</p>
            <button class="add-to-cart"onclick="addToCart('white sause pasta', 1100)">Add to Cart</button>
        </div>
    </div>
</div>
<div class="col-md-3 menu-item pasta">
    <div class="card menu-card">
        <img src="assets/images/italian.jpeg" class="menu-img">
        <div class="card-body">
            <h5>Italian Pasta</h5>
            <p>Rs 1900</p>
            <button class="add-to-cart"onclick="addToCart('Italian pasta', 1900)">Add to Cart</button>
        </div>
    </div>
</div>


</div>

<!-- CART SECTION -->




<!-- JS FILTER -->
<script>
function filterMenu(category) {
    let items = document.querySelectorAll('.menu-item');

    items.forEach(item => {
        if (category === 'all') {
            item.style.display = 'block';
        } else {
            if (item.classList.contains(category)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }
    });
}
document.addEventListener("DOMContentLoaded", syncCartUI);

//menu.php

</script>
<script src="assets/js/cart.js"></script>
</body>
</html>