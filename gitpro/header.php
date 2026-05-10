<?php if(empty($hide_navbar)): ?>

<header class="header">

    <!-- LOGO -->
    <a href="index.php" class="logo">
        <img src="assets/images/logo.png" class="img-logo" alt="Logo">
    </a>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">About</a>
        <a href="menu.php">Menu</a>
        <a href="index.php#gallery">Gallery</a>
        <a href="index.php#blogs">Blogs</a>
        <a href="index.php#contact">Contact</a>
        <a href="team/theme.php">Our Team</a>
    </nav>

    <!-- ICONS -->
    <div class="icons">

        <!-- USER DROPDOWN (3 lines icon) — BEFORE cart -->
        <div class="user-menu-wrapper">
            <div class="fas fa-bars user-icon-btn" id="user-menu-btn"></div>

            <div class="user-dropdown" id="user-dropdown">
                <?php if(isset($_SESSION['username'])): ?>
                    <div class="user-dropdown-name">
                        👤 <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </div>
                    <a href="users/logout.php" class="user-dropdown-item logout-item">
                        🚪 Logout
                    </a>
                <?php else: ?>
                    <a href="users/login.php" class="user-dropdown-item">🔑 Login</a>
                    <a href="users/registration.php" class="user-dropdown-item">📝 Register</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- CART ICON -->
        <div class="fas fa-shopping-cart" id="cart-btn">
            <span id="cart-count">0</span>
        </div>

    </div>

    <!-- SEARCH -->
    <div class="search-form">
        <input type="search" id="search-box" placeholder="Search...">
    </div>

    <!-- CART PANEL -->
    <div class="cart" id="cart-panel">
        <h3>Your Cart</h3>
        <div id="cart-items" class="cart-items"></div>
        <div class="cart-footer">
            <div id="home-total" style="display:none;"></div>
            <button onclick="checkout()" class="checkout-btn">Checkout</button>
        </div>
    </div>

</header>

<?php endif; ?>

<!-- ALWAYS LOAD JS -->
<script src="assets/js/cart.js"></script>
<script src="assets/js/search.js"></script>

<style>
.user-menu-wrapper {
    position: relative;
    display: inline-block;
}

.user-icon-btn {
    color: #fff;
    font-size: 2.5rem;
    cursor: pointer;
    margin-left: 2rem;
}

.user-icon-btn:hover {
    color: #9F5C44;
}

.user-dropdown {
    display: none;
    position: absolute;
    top: 140%;
    right: 0;
    background: #1a1a2e;
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 8px;
    min-width: 180px;
    z-index: 9999;
    box-shadow: 0 8px 24px rgba(0,0,0,0.5);
    overflow: hidden;
}

.user-dropdown.active {
    display: block;
}

.user-dropdown-name {
    padding: 10px 16px;
    color: #e7a891;
    font-size: 1.4rem;
    font-weight: 600;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    cursor: default;
}

.user-dropdown-item {
    display: block;
    padding: 10px 16px;
    color: #fff;
    font-size: 1.4rem;
    text-decoration: none;
    transition: background 0.2s;
}

.user-dropdown-item:hover {
    background: rgba(159,92,68,0.3);
    color: #e7a891;
}

.logout-item {
    color: #ff6b6b;
}

.logout-item:hover {
    background: rgba(255,107,107,0.15);
    color: #ff4444;
}
</style>

<script>
document.getElementById('user-menu-btn').addEventListener('click', function(e) {
    e.stopPropagation();
    document.getElementById('user-dropdown').classList.toggle('active');
});

document.addEventListener('click', function() {
    document.getElementById('user-dropdown').classList.remove('active');
});
</script>