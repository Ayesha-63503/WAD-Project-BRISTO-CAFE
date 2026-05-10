<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Resources</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #1c1c1c, #2c2c2c);
    color: #fff;
}

/* HERO */
.hero {
    text-align: center;
    padding: 70px 20px;
    background: rgba(0,0,0,0.3);
}

.hero h1 {
    font-size: 42px;
    margin-bottom: 10px;
}

.hero p {
    color: #bbb;
}

/* GRID */
.container {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

/* CARD */
.card {
    background: #2f2f2f;
    border-radius: 14px;
    padding: 20px;
    border: 1px solid #444;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-6px);
    border-color: #ff4b2b;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
}

.card h3 {
    color: #ff4b2b;
    margin-bottom: 15px;
}

/* LINKS */
.card a {
    display: block;
    color: #ccc;
    text-decoration: none;
    margin: 10px 0;
    transition: 0.2s;
}

.card a:hover {
    color: #fff;
    padding-left: 6px;
}

/* FOOTER */
.footer {
    text-align: center;
    padding: 20px;
    border-top: 1px solid #444;
    color: #aaa;
    margin-top: 40px;
}
</style>

</head>

<body>

<div class="hero">
    <h1>Resources</h1>
    <p>Help, policies, and guides — everything in one place</p>
</div>

<div class="container">

    <!-- HELP CENTER -->
    <div class="card">
        <h3>Help Center</h3>
        <a href="help-center.php">Help Center</a>
        <a href="faq.php">FAQs</a>
        <a href="support-guides.php">Support Guides</a>
        <a href="live-chat.php">Live Chat</a>
    </div>

    <!-- POLICIES -->
    <div class="card">
        <h3>Policies</h3>
        <a href="privacy-policy.php">Privacy Policy</a>
        <a href="terms.php">Terms & Conditions</a>
        <a href="refund-policy.php">Refund Policy</a>
    </div>

    <!-- EXTRA -->
    <div class="card">
        <h3>Company</h3>
        <a href="../about.php">About Us</a>
        <a href="../affiliates.php">Affiliates</a>
        <a href="../partnership.php">Partnership</a>
        <a href="../suppliers.php">Suppliers</a>
    </div>

</div>

<div class="footer">
    © 2026 Baresto | All Rights Reserved
</div>

</body>
</html>