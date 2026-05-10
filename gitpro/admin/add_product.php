<?php
include '../config/db.php';

$message = "";
$msgType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $price    = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $ext       = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $imageName = uniqid('prod_', true) . '.' . $ext;
    $tempName  = $_FILES['image']['tmp_name'];
    $targetFolder = "../assets/images/" . $imageName;

    if (!is_dir("../assets/images/")) {
        mkdir("../assets/images/", 0755, true);
    }

    if (!move_uploaded_file($tempName, $targetFolder)) {
        $message = "Image upload failed. Please try again.";
        $msgType = "error";
    } else {
        $sql = "INSERT INTO products (name, price, category, image)
                VALUES ('$name', '$price', '$category', '$imageName')";

        if (mysqli_query($conn, $sql)) {
            $newID   = mysqli_insert_id($conn);
            $message = "Product added successfully! (ID #$newID)";
            $msgType = "success";
        } else {
            $message = "Database error: " . mysqli_error($conn);
            $msgType = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product — Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg:           #f5f2ee;
    --surface:      #ffffff;
    --border:       #e2dbd4;
    --border-focus: #8a6840;
    --brown:        #6f4e37;
    --brown-dk:     #4a3325;
    --amber:        #c49b64;
    --text:         #1c1412;
    --sub:          #7a6a58;
    --muted-bg:     #f9f6f2;
    --success:      #2e7d52;
    --danger:       #c0392b;
    --green:        #7ec99a;
}

body {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'Geist', sans-serif;
    color: var(--text);
    display: flex;
    flex-direction: column;
}

/* ── NAV ── */
nav {
    height: 54px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    display: flex;
    align-items: center;
    padding: 0 32px;
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

/* ── MAIN ── */
main {
    flex: 1;
    max-width: 620px;
    width: 100%;
    margin: 0 auto;
    padding: 40px 24px 60px;
}

.page-title {
    margin-bottom: 32px;
}
.page-title h1 {
    font-family: 'Instrument Serif', serif;
    font-size: 2rem;
    font-weight: 400;
    line-height: 1.1;
}
.page-title h1 em { font-style: italic; color: var(--brown); }
.page-title p {
    font-size: 0.82rem;
    color: var(--sub);
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
    animation: fadeIn 0.3s ease;
}
.alert-success { background: #f0faf4; border-color: #a8d5b8; color: var(--success); }
.alert-error   { background: #fdf2f2; border-color: #f0b8b8; color: var(--danger); }
@keyframes fadeIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:none; } }

/* ── FORM ── */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}
.span-2 { grid-column: 1 / -1; }

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
input:focus, select:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(138,104,64,0.1);
}
select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237a6a58' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 36px;
    cursor: pointer;
}
select option[value=""] { color: #bbb0a4; }

/* price prefix */
.prefix-wrap { position: relative; }
.prefix-wrap span {
    position: absolute; left: 12px; top: 50%;
    transform: translateY(-50%);
    color: var(--sub); font-size: 0.82rem; pointer-events: none;
}
.prefix-wrap input { padding-left: 34px; }

/* ── IMAGE UPLOAD ── */
.upload-zone {
    grid-column: 1 / -1;
    border: 2px dashed var(--border);
    border-radius: 12px;
    padding: 28px 20px;
    text-align: center;
    background: var(--muted-bg);
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    position: relative;
}
.upload-zone:hover,
.upload-zone.dragover {
    border-color: var(--amber);
    background: #fdf8f2;
}
.upload-zone input[type=file] {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer;
    width: 100%; height: 100%;
    padding: 0; border: none;
}
.upload-icon {
    width: 44px; height: 44px;
    background: #f0e8de;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 10px;
    color: var(--amber); font-size: 1.1rem;
}
.upload-zone p {
    font-size: 0.83rem; color: var(--sub); line-height: 1.6;
}
.upload-zone strong { color: var(--brown); }
.file-name {
    margin-top: 10px;
    font-size: 0.78rem;
    color: var(--brown);
    display: none;
}
.file-name i { margin-right: 5px; }

/* preview */
#img-preview {
    width: 80px; height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid var(--border);
    margin: 10px auto 0;
    display: none;
}

/* ── ACTIONS ── */
.actions {
    grid-column: 1 / -1;
    display: flex; gap: 12px;
    margin-top: 4px;
}
.btn-submit {
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
}
.btn-submit:hover  { background: var(--brown-dk); }
.btn-submit:active { transform: scale(0.99); }

.btn-back {
    padding: 12px 20px;
    background: transparent;
    color: var(--sub);
    border: 1px solid var(--border);
    border-radius: 9px;
    font-family: 'Geist', sans-serif;
    font-size: 0.88rem;
    text-decoration: none;
    display: flex; align-items: center; gap: 7px;
    transition: border-color 0.18s, color 0.18s;
    white-space: nowrap;
}
.btn-back:hover { border-color: var(--brown); color: var(--brown); }

@media (max-width: 520px) {
    .form-grid { grid-template-columns: 1fr; }
    .upload-zone { padding: 20px; }
}
</style>
</head>
<body>

<nav>
    <span class="nav-brand">☕ BrewVoyage</span>
    <div class="breadcrumb">
        <a href="dashboard.php">Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <span>Add Product</span>
    </div>
</nav>

<main>

    <div class="page-title">
        <h1>Add <em>Product</em></h1>
        <p>Fill in the details below to add a new item to the menu.</p>
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
                <input type="text" name="name" placeholder="e.g. Caramel Latte" required>
            </div>

            <!-- Price -->
            <div class="field">
                <label>Price</label>
                <div class="prefix-wrap">
                    <span>Rs</span>
                    <input type="number" step="0.01" name="price" placeholder="0.00" required>
                </div>
            </div>

            <!-- Category -->
            <div class="field">
                <label>Category</label>
                <select name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="coffee">☕ Coffee</option>
                    <option value="pizza">🍕 Pizza</option>
                    <option value="drinks">🥤 Drinks</option>
                    <option value="dessert">🍰 Dessert</option>
                    <option value="sandwich">🥪 Sandwich</option>
                    <option value="pasta">🍝 Pasta</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="upload-zone" id="upload-zone">
                <input type="file" name="image" id="file-input" accept="image/*" required>
                <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <p><strong>Click to upload</strong> or drag & drop<br>JPG, PNG, WEBP supported</p>
                <img id="img-preview" src="" alt="Preview">
                <div class="file-name" id="file-name">
                    <i class="fas fa-image"></i><span id="fname"></span>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="dashboard.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>

        </div>
    </form>

</main>

<script>
const input   = document.getElementById('file-input');
const zone    = document.getElementById('upload-zone');
const preview = document.getElementById('img-preview');
const nameBox = document.getElementById('file-name');
const fname   = document.getElementById('fname');

input.addEventListener('change', () => {
    const file = input.files[0];
    if (!file) return;
    fname.textContent = file.name;
    nameBox.style.display = 'block';
    const reader = new FileReader();
    reader.onload = e => {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(file);
});

zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('dragover'); });
zone.addEventListener('dragleave', ()  => zone.classList.remove('dragover'));
zone.addEventListener('drop',      e => {
    e.preventDefault();
    zone.classList.remove('dragover');
    input.files = e.dataTransfer.files;
    input.dispatchEvent(new Event('change'));
});
</script>

</body>
</html>