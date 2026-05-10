<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --bg:        #0c0a08;
        --surface:   #141210;
        --border:    rgba(196, 155, 100, 0.18);
        --gold:      #c49b64;
        --gold-soft: rgba(196, 155, 100, 0.08);
        --text:      #e8ddd0;
        --muted:     #7a6a58;
        --red:       #e06060;
        --green:     #7ec99a;
        --blue:      #7ab4dc;
        --amber:     #e0a84a;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        min-height: 100vh;
        background: var(--bg);
        background-image:
            radial-gradient(ellipse 80% 60% at 10% 0%, rgba(196,155,100,0.07) 0%, transparent 60%),
            radial-gradient(ellipse 50% 40% at 90% 100%, rgba(196,155,100,0.05) 0%, transparent 60%);
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* ── TOP BAR ── */
    header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 48px;
        border-bottom: 1px solid var(--border);
        background: rgba(12,10,8,0.8);
        backdrop-filter: blur(12px);
        position: sticky; top: 0; z-index: 50;
    }

    .brand {
        display: flex; align-items: center; gap: 14px;
    }
    .brand-icon {
        width: 42px; height: 42px;
        background: linear-gradient(135deg, #c49b64, #8a6840);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .brand-text h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem; font-weight: 700;
        letter-spacing: 0.5px;
        line-height: 1;
    }
    .brand-text span {
        font-size: 0.7rem; color: var(--muted);
        letter-spacing: 2px; text-transform: uppercase;
    }

    .header-right {
        display: flex; align-items: center; gap: 20px;
    }
    .admin-badge {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 16px;
        border: 1px solid var(--border);
        border-radius: 30px;
        font-size: 0.8rem; color: var(--muted);
    }
    .admin-badge i { color: var(--gold); }

    .logout-btn {
        padding: 8px 18px;
        background: transparent;
        border: 1px solid rgba(224,96,96,0.3);
        color: var(--red);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.8rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        display: flex; align-items: center; gap: 6px;
    }
    .logout-btn:hover {
        background: rgba(224,96,96,0.08);
        border-color: var(--red);
    }

    /* ── MAIN ── */
    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 24px;
    }

    .welcome {
        text-align: center;
        margin-bottom: 56px;
    }
    .welcome h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem; font-weight: 600;
        letter-spacing: -0.5px;
        line-height: 1.1;
    }
    .welcome h2 span { color: var(--gold); }
    .welcome p {
        color: var(--muted); font-size: 0.88rem;
        margin-top: 10px; letter-spacing: 0.5px;
    }

    /* ── GRID ── */
    .grid {
        display: grid;
        grid-template-columns: repeat(3, 220px);
        gap: 18px;
        max-width: 720px;
    }

    .card {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 32px 24px;
        text-align: center;
        text-decoration: none;
        color: var(--text);
        transition: all 0.25s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        cursor: pointer;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.5s ease forwards;
    }

    .card:nth-child(1) { animation-delay: 0.05s; }
    .card:nth-child(2) { animation-delay: 0.10s; }
    .card:nth-child(3) { animation-delay: 0.15s; }
    .card:nth-child(4) { animation-delay: 0.20s; }
    .card:nth-child(5) { animation-delay: 0.25s; }

    @keyframes fadeUp {
        to { opacity: 1; transform: translateY(0); }
    }

    /* glow spot on hover */
    .card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 0%, var(--card-glow, rgba(196,155,100,0.12)) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .card:hover::before { opacity: 1; }

    .card:hover {
        border-color: rgba(196,155,100,0.45);
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(196,155,100,0.12);
    }

    .card-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.35rem;
        background: var(--card-bg, var(--gold-soft));
        border: 1px solid var(--card-border, var(--border));
        transition: transform 0.25s;
        color: var(--card-color, var(--gold));
    }
    .card:hover .card-icon { transform: scale(1.1) rotate(-4deg); }

    .card-label {
        font-size: 0.88rem;
        font-weight: 500;
        letter-spacing: 0.3px;
        color: var(--text);
    }
    .card-sub {
        font-size: 0.7rem;
        color: var(--muted);
        margin-top: -8px;
    }

    /* per-card accent colours */
    .card-add    { --card-color: var(--green);  --card-bg: rgba(126,201,154,0.08); --card-border: rgba(126,201,154,0.2); --card-glow: rgba(126,201,154,0.1); }
    .card-view   { --card-color: var(--blue);   --card-bg: rgba(122,180,220,0.08); --card-border: rgba(122,180,220,0.2); --card-glow: rgba(122,180,220,0.1); }
    .card-edit   { --card-color: var(--amber);  --card-bg: rgba(224,168,74,0.08);  --card-border: rgba(224,168,74,0.2);  --card-glow: rgba(224,168,74,0.1); }
    .card-delete { --card-color: var(--red);    --card-bg: rgba(224,96,96,0.08);   --card-border: rgba(224,96,96,0.2);   --card-glow: rgba(224,96,96,0.1); }
    .card-orders { --card-color: var(--gold);   --card-bg: rgba(196,155,100,0.08); --card-border: rgba(196,155,100,0.2); --card-glow: rgba(196,155,100,0.12); }

    /* ── FOOTER ── */
    footer {
        text-align: center;
        padding: 24px;
        font-size: 0.72rem;
        color: var(--muted);
        border-top: 1px solid var(--border);
        letter-spacing: 0.5px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 680px) {
        header { padding: 16px 20px; }
        .grid  { grid-template-columns: repeat(2, 1fr); max-width: 460px; }
        .welcome h2 { font-size: 2rem; }
    }
</style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="brand">
        <div class="brand-icon">☕</div>
        <div class="brand-text">
            <h1>Baristo</h1>
            <span>Admin Panel</span>
        </div>
    </div>
    <div class="header-right">
        <div class="admin-badge">
            <i class="fas fa-circle" style="font-size:7px;"></i>
            Administrator
        </div>
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</header>

<!-- MAIN -->
<main>
    <div class="welcome">
        <h2>Welcome back, <span>Admin</span></h2>
        <p>Manage your coffee shop from one place</p>
    </div>

    <div class="grid">

        <a class="card card-add" href="add_product.php">
            <div class="card-icon"><i class="fas fa-plus"></i></div>
            <div class="card-label">Add Product</div>
            <div class="card-sub">Create new menu item</div>
        </a>

        <a class="card card-view" href="view_products.php">
            <div class="card-icon"><i class="fas fa-box-open"></i></div>
            <div class="card-label">View Products</div>
            <div class="card-sub">Browse all items</div>
        </a>

        <a class="card card-edit" href="find_product.php">
            <div class="card-icon"><i class="fas fa-pen"></i></div>
            <div class="card-label">Edit Product</div>
            <div class="card-sub">Update existing items</div>
        </a>

        <a class="card card-delete" href="delete_product.php">
            <div class="card-icon"><i class="fas fa-trash-alt"></i></div>
            <div class="card-label">Delete Product</div>
            <div class="card-sub">Remove from menu</div>
        </a>

        <a class="card card-orders" href="orders.php">
            <div class="card-icon"><i class="fas fa-receipt"></i></div>
            <div class="card-label">Manage Orders</div>
            <div class="card-sub">Update order status</div>
        </a>

    </div>
</main>

<footer>
    &copy; <?php echo date('Y'); ?> BrewVoyage &nbsp;·&nbsp; Admin Dashboard
</footer>

</body>
</html>