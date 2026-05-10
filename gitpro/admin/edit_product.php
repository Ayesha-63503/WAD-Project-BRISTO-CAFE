<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) die("Access Denied");
if (!isset($_GET['id']))        die("Product ID Missing");

$id    = (int) $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$id'");

if (mysqli_num_rows($query) == 0) die("Product Not Found");

$product = mysqli_fetch_assoc($query);
$message = "";
$msgType = "";

if (isset($_POST['update'])) {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $price       = mysqli_real_escape_string($conn, $_POST['price']);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);
    $image       = $product['image'];

    if (!empty($_FILES['image']['name'])) {
        $newImage = time() . "_" . $_FILES['image']['name'];
        $target   = "../assets/images/" . $newImage;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) $image = $newImage;
    }

    $update = mysqli_query($conn, "
        UPDATE products SET
        name='$name', price='$price',
        category='$category', image='$image'
        WHERE product_id='$id'
    ");

    if ($update) {
        $message = "Product updated successfully.";
        $msgType = "success";
        $query   = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$id'");
        $product = mysqli_fetch_assoc($query);
    } else {
        $message = "Update failed. Please try again.";
        $msgType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Product — Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg:       #f5f2ee;
    --surface:  #ffffff;
    --border:   #e2dbd4;
    --border-focus: #8a6840;
    --brown:    #6f4e37;
    --brown-dk: #4a3325;
    --amber:    #c49b64;
    --text:     #1c1412;
    --sub:      #7a6a58;
    --danger:   #c0392b;
    --success:  #2e7d52;
    --muted-bg: #f9f6f2;
}

body {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'Geist', sans-serif;
    color: var(--text);
    display: flex;
    flex-direction: column;
}

/* ── TOP NAV ── */
nav {
    height: 54px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    display: flex;
    align-items: center;
    padding: 0 32px;
    gap: 8px;
    position: sticky; top: 0; z-index: 10;
}
.nav-brand {
    font-family: 'Instrument Serif', serif;
    font-size: 1.1rem;
    color: var(--brown);
    margin-right: auto;
}
.breadcrumb {
    display: flex; align-items: center; gap: 6px;
    font-size: 0.78rem; color: var(--sub);
}
.breadcrumb a { color: var(--sub); text-decoration: none; }
.breadcrumb a:hover { color: var(--brown); }
.breadcrumb i { font-size: 0.6rem; }

/* ── LAYOUT ── */
main {
    flex: 1;
    max-width: 780px;
    width: 100%;
    margin: 0 auto;
    padding: 40px 24px 60px;
}

/* ── PAGE TITLE ── */
.page-title {
    display: flex; align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 32px;
    gap: 12px;
}
.page-title h1 {
    font-family: 'Instrument Serif', serif;
    font-size: 2rem;
    font-weight: 400;
    line-height: 1.1;
    color: var(--text);
}
.page-title h1 em {
    font-style: italic;
    color: var(--brown);
}
.pid-tag {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px;
    background: var(--muted-bg);
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 0.75rem;
    color: var(--sub);
    font-family: 'Geist', monospace;
    white-space: nowrap;
    margin-top: 6px;
}

/* ── ALERT ── */
.alert {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 0.83rem;
    margin-bottom: 24px;
    border: 1px solid;
}
.alert-success { background: #f0faf4; border-color: #a8d5b8; color: var(--success); }
.alert-error   { background: #fdf2f2; border-color: #f0b8b8; color: var(--danger); }

/* ── GRID ── */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.span-2 { grid-column: 1 / -1; }

/* ── FIELD ── */
.field { display: flex; flex-direction: column; gap: 6px; }

label {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: var(--sub);
}

input[type=text],
input[type=number],
input[type=file],
textarea,
select {
    width: 100%;
    padding: 10px 13px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    font-family: 'Geist', sans-serif;
    font-size: 0.88rem;
    color: var(--text);
    outline: none;
    transition: border-color 0.18s, box-shadow 0.18s;
    -webkit-appearance: none;
}
input:focus, textarea:focus, select:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(138,104,64,0.1);
}
input[readonly] {
    background: var(--muted-bg);
    color: var(--sub);
    cursor: not-allowed;
}
textarea { resize: vertical; min-height: 100px; line-height: 1.55; }

/* price prefix */
.prefix-wrap { position: relative; }
.prefix-wrap span {
    position: absolute; left: 12px; top: 50%;
    transform: translateY(-50%);
    color: var(--sub); font-size: 0.82rem; pointer-events: none;
}
.prefix-wrap input { padding-left: 34px; }

/* ── IMAGE PANEL ── */
.image-panel {
    grid-column: 1 / -1;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px;
    align-items: start;
    padding: 20px;
    background: var(--muted-bg);
    border: 1px solid var(--border);
    border-radius: 12px;
}
.img-preview {
    width: 100px; height: 100px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid var(--border);
    display: block;
}
.img-placeholder {
    width: 100px; height: 100px;
    border-radius: 10px;
    border: 1px dashed var(--border);
    display: flex; align-items: center; justify-content: center;
    color: var(--sub); font-size: 1.5rem;
    background: var(--surface);
}
.image-right { display: flex; flex-direction: column; gap: 8px; }
.image-right .current-name {
    font-size: 0.78rem; color: var(--sub);
    display: flex; align-items: center; gap: 6px;
}
.image-right .current-name i { color: var(--amber); }

input[type=file] {
    padding: 8px 10px;
    cursor: pointer;
    font-size: 0.82rem;
    color: var(--sub);
}
input[type=file]::file-selector-button {
    padding: 5px 12px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 6px;
    font-family: 'Geist', sans-serif;
    font-size: 0.78rem;
    color: var(--brown);
    cursor: pointer;
    margin-right: 10px;
    transition: background 0.15s;
}
input[type=file]::file-selector-button:hover { background: #f3ece4; }
.file-hint { font-size: 0.72rem; color: var(--sub); }

/* ── DIVIDER ── */
.section-divider {
    grid-column: 1 / -1;
    height: 1px;
    background: var(--border);
    margin: 4px 0;
}

/* ── ACTIONS ── */
.actions {
    grid-column: 1 / -1;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 4px;
}
.btn-update {
    flex: 1;
    padding: 12px 20px;
    background: var(--brown);
    color: #fff;
    border: none;
    border-radius: 9px;
    font-family: 'Geist', sans-serif;
    font-size: 0.88rem;
    font-weight: 500;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: background 0.18s, transform 0.12s;
    letter-spacing: 0.2px;
}
.btn-update:hover  { background: var(--brown-dk); }
.btn-update:active { transform: scale(0.99); }

.btn-back {
    padding: 12px 20px;
    background: transparent;
    color: var(--sub);
    border: 1px solid var(--border);
    border-radius: 9px;
    font-family: 'Geist', sans-serif;
    font-size: 0.88rem;
    cursor: pointer;
    text-decoration: none;
    display: flex; align-items: center; gap: 7px;
    transition: border-color 0.18s, color 0.18s;
    white-space: nowrap;
}
.btn-back:hover { border-color: var(--brown); color: var(--brown); }

@media (max-width: 560px) {
    .form-grid { grid-template-columns: 1fr; }
    .image-panel { grid-template-columns: 1fr; }
    .page-title { flex-direction: column; }
}
</style>
</head>
<body>

<nav>
    <span class="nav-brand">☕ BrewVoyage</span>
    <div class="breadcrumb">
        <a href="dashboard.php">Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <a href="view_products.php">Products</a>
        <i class="fas fa-chevron-right"></i>
        <span>Edit</span>
    </div>
</nav>

<main>

    <div class="page-title">
        <h1>Edit <em>Product</em></h1>
        <div class="pid-tag"><i class="fas fa-fingerprint"></i> ID #<?php echo $product['product_id']; ?></div>
    </div>

    <?php if ($message): ?>
    <div class="alert alert-<?php echo $msgType; ?>">
        <i class="fas fa-<?php echo $msgType === 'success' ? 'check-circle' : 'times-circle'; ?>"></i>
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-grid">

            <!-- Name -->
            <div class="field span-2">
                <label>Product Name</label>
                <input type="text" name="name"
                       value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>

            <!-- Price -->
            <div class="field">
                <label>Price</label>
                <div class="prefix-wrap">
                    <span>Rs</span>
                    <input type="number" step="0.01" name="price"
                           value="<?php echo $product['price']; ?>" required>
                </div>
            </div>

            <!-- Category -->
            <div class="field">
                <label>Category</label>
                <input type="text" name="category"
                       value="<?php echo htmlspecialchars($product['category']); ?>" required>
            </div>

            <!-- Image -->
            <div class="image-panel">
                <?php
                $imagePath = "../assets/images/" . $product['image'];
                if (!empty($product['image']) && file_exists($imagePath)):
                ?>
                    <img src="<?php echo $imagePath; ?>" class="img-preview" alt="Product">
                <?php else: ?>
                    <div class="img-placeholder"><i class="fas fa-image"></i></div>
                <?php endif; ?>

                <div class="image-right">
                    <label>Current Image</label>
                    <div class="current-name">
                        <i class="fas fa-image"></i>
                        <?php echo !empty($product['image']) ? htmlspecialchars($product['image']) : 'No image set'; ?>
                    </div>
                    <label style="margin-top:8px;">Replace Image</label>
                    <input type="file" name="image" accept="image/*">
                    <span class="file-hint">JPG, PNG, WEBP · Leave empty to keep current</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="view_products.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" name="update" class="btn-update">
                    <i class="fas fa-check"></i> Save Changes
                </button>
            </div>

        </div>

    </form>

</main>

</body>
</html>