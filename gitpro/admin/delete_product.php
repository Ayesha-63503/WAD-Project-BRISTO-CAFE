<?php
include '../config/db.php';

$success = "";
$error = "";
$product = null;

/* =========================
   DELETE DIRECTLY FROM VIEW
   ========================= */
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $check = mysqli_query($conn, "SELECT * FROM products WHERE product_id=$id");

    if ($check && mysqli_num_rows($check) > 0) {
        $product = mysqli_fetch_assoc($check);
        $imagePath = "../assets/images/" . $product['image'];
        if (file_exists($imagePath)) unlink($imagePath);

        $delete = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
        if ($delete) { header("Location: view_products.php?deleted=1"); exit(); }
        else $error = "Failed to delete product.";
    } else {
        $error = "Invalid Product ID.";
    }
}

/* =========================
   MANUAL DELETE FORM
   ========================= */
if (isset($_POST['delete'])) {
    $id   = (int) $_POST['product_id'];
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);

    $check = mysqli_query($conn, "SELECT * FROM products WHERE product_id=$id AND name='$name'");

    if ($check && mysqli_num_rows($check) > 0) {
        $product   = mysqli_fetch_assoc($check);
        $imagePath = "../assets/images/" . $product['image'];
        if (file_exists($imagePath)) unlink($imagePath);

        $delete = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
        if ($delete) $success = "Product deleted successfully!";
        else         $error   = "Delete failed. Please try again.";
    } else {
        $error = "No product found with that ID and Name.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Product</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --bg:       #0c0a08;
        --surface:  #141210;
        --surface2: #1b1815;
        --border:   rgba(196,155,100,0.15);
        --gold:     #c49b64;
        --red:      #e06060;
        --red-soft: rgba(224,96,96,0.08);
        --red-border:rgba(224,96,96,0.25);
        --green:    #7ec99a;
        --text:     #e8ddd0;
        --muted:    #7a6a58;
    }

    * { margin:0; padding:0; box-sizing:border-box; }

    body {
        min-height: 100vh;
        background: var(--bg);
        background-image:
            radial-gradient(ellipse 70% 50% at 15% 0%,  rgba(231, 131, 131, 0.06) 0%, transparent 60%),
            radial-gradient(ellipse 50% 40% at 85% 100%, rgba(196,155,100,0.05) 0%, transparent 60%);
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    /* ── CARD ── */
    .card {
        width: 100%;
        max-width: 440px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px;
        padding: 40px 36px;
        box-shadow: 0 32px 64px rgba(0,0,0,0.5);
        animation: fadeUp 0.45s ease both;
    }
    @keyframes fadeUp {
        from { opacity:0; transform:translateY(18px); }
        to   { opacity:1; transform:translateY(0); }
    }

    /* ── HEADER ── */
    .card-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        margin-bottom: 32px;
    }
    .icon-wrap {
        width: 58px; height: 58px;
        border-radius: 16px;
        background: var(--red-soft);
        border: 1px solid var(--red-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        color: var(--red);
    }
    .card-header h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.75rem; font-weight: 700;
        letter-spacing: -0.3px;
    }
    .card-header p {
        font-size: 0.8rem; color: var(--muted);
        text-align: center; line-height: 1.5;
    }

    /* ── FORM ── */
    .field { margin-bottom: 18px; }

    label {
        display: block;
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--muted);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .input-wrap {
        position: relative;
    }
    .input-wrap i {
        position: absolute;
        left: 14px; top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: 0.85rem;
        pointer-events: none;
    }
    input {
        width: 100%;
        padding: 12px 14px 12px 38px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    input:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(224,96,96,0.1);
    }
    input::placeholder { color: #3a3028; }
    input[type=number]::-webkit-inner-spin-button { opacity: 0.3; }

    /* ── WARNING BOX ── */
    .warning-box {
        display: flex; align-items: flex-start; gap: 10px;
        background: rgba(224,96,96,0.06);
        border: 1px solid rgba(224,96,96,0.2);
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 22px;
        font-size: 0.78rem;
        color: #c98080;
        line-height: 1.5;
    }
    .warning-box i { color: var(--red); margin-top: 2px; flex-shrink: 0; }

    /* ── BUTTON ── */
    .btn-delete {
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #c84848, #e06060);
        border: none;
        border-radius: 10px;
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: opacity 0.2s, transform 0.15s;
        letter-spacing: 0.3px;
    }
    .btn-delete:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-delete:active { transform: translateY(0); }

    /* ── ALERTS ── */
    .alert {
        display: flex; align-items: center; gap: 10px;
        padding: 13px 16px;
        border-radius: 10px;
        font-size: 0.83rem;
        margin-top: 18px;
        animation: fadeUp 0.3s ease both;
    }
    .alert-success {
        background: rgba(126,201,154,0.1);
        border: 1px solid rgba(126,201,154,0.25);
        color: var(--green);
    }
    .alert-error {
        background: rgba(224,96,96,0.08);
        border: 1px solid rgba(224,96,96,0.25);
        color: #e08080;
    }

    /* ── DIVIDER ── */
    .divider {
        display: flex; align-items: center; gap: 12px;
        margin: 24px 0 0;
    }
    .divider::before, .divider::after {
        content: ''; flex: 1;
        height: 1px; background: var(--border);
    }
    .divider span { font-size: 0.72rem; color: var(--muted); }

    /* ── BACK LINK ── */
    .back-link {
        display: flex; align-items: center; justify-content: center; gap: 7px;
        margin-top: 18px;
        color: var(--muted);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.2s;
    }
    .back-link:hover { color: var(--gold); }

    @media (max-width: 480px) {
        .card { padding: 32px 24px; }
    }
</style>
</head>
<body>

<div class="card">

    <div class="card-header">
        <div class="icon-wrap"><i class="fas fa-trash-alt"></i></div>
        <h2>Delete Product</h2>
        <p>Enter the product ID and name to permanently remove it from the menu.</p>
    </div>

    <div class="warning-box">
        <i class="fas fa-exclamation-triangle"></i>
        <span>This action is <strong>irreversible</strong>. The product and its image will be permanently deleted.</span>
    </div>

    <form method="POST">

        <div class="field">
            <label>Product ID</label>
            <div class="input-wrap">
                <i class="fas fa-hashtag"></i>
                <input type="number" name="product_id" placeholder="e.g. 12" required>
            </div>
        </div>

        <div class="field">
            <label>Product Name</label>
            <div class="input-wrap">
                <i class="fas fa-tag"></i>
                <input type="text" name="product_name" placeholder="e.g. Caramel Latte" required>
            </div>
        </div>

        <button class="btn-delete" type="submit" name="delete"
                onclick="return confirm('Are you sure you want to delete this product? This cannot be undone.')">
            <i class="fas fa-trash-alt"></i> Delete Product
        </button>

    </form>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fas fa-times-circle"></i> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="divider"><span>or</span></div>

    <a class="back-link" href="view_products.php">
        <i class="fas fa-arrow-left"></i> Back to Products
    </a>

</div>

</body>
</html>