<header class="header">

    <!-- LOGO -->
    <a href="index.php" class="logo">
        <img src="assets/images/logo.png" class="img-logo" alt="Logo">
    </a>

    <!-- NAVBAR (FULL OPTIONS) -->
    <nav class="navbar">

        <a href="index.php#home">Home</a>
        <a href="index.php#about">About</a>
        <a href="menu.php">Menu</a>
        <a href="index.php#gallery">Gallery</a>
        <a href="index.php#blogs">Blogs</a>
        <a href="index.php#contact">Contact</a>
        <a href="users/login.php">Login</a>
        <a href="team/theme.php">Our Team</a>
        

    </nav>

    <!-- ICONS -->
    <div class="icons">

        

        <div class="fas fa-shopping-cart" id="cart-btn">
            <span id="cart-count">0</span>
        </div>

        <div class="fas fa-bars" id="menu-btn"></div>

    </div>

    <!-- SEARCH -->
    <div class="search-form">
        <input type="search" id="search-box" placeholder="Search...">
    </div>

    <!-- CART PANEL -->
  <div class="cart" id="cart-panel">

    <h3>Your Cart</h3>

    <!-- SCROLL AREA -->
    <div id="cart-items" class="cart-items"></div>

    <!-- FIXED BOTTOM -->
    <div class="cart-footer">
        <div id="home-total" style="display:none;"></div>

    <button onclick="checkout()" class="checkout-btn">
        Checkout
    </button>
    </div>

</div>
</header>

<script src="assets/js/cart.js"></script>
<script src="assets/js/search.js"></script>
