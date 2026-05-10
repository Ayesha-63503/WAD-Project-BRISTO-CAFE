<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers - Baresto</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: #0d0d0d;
            background-image:
                radial-gradient(ellipse at 15% 25%, rgba(159,92,68,0.12) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 75%, rgba(101,55,38,0.1) 0%, transparent 50%);
            font-family: 'Poppins', sans-serif;
            color: #f0e6df;
            padding: 60px 20px;
        }

        .container { max-width: 960px; margin: 0 auto; }

        /* BACK LINK */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #9F5C44;
            font-size: 0.9rem;
            text-decoration: none;
            margin-bottom: 48px;
            transition: gap 0.2s;
        }
        .back-link:hover { gap: 12px; color: #c47a5a; }

        /* HERO */
        .hero { text-align: center; margin-bottom: 60px; animation: fadeUp 0.7s ease both; }

        .badge {
            display: inline-block;
            background: rgba(159,92,68,0.15);
            border: 1px solid rgba(159,92,68,0.35);
            color: #c47a5a;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 18px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: #f0e6df;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .hero h1 span { font-style: italic; color: #c47a5a; }

        .hero p {
            color: #8a7060;
            font-size: 1rem;
            font-weight: 300;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .divider {
            width: 60px; height: 2px;
            background: linear-gradient(to right, #9F5C44, #c47a5a);
            margin: 24px auto; border-radius: 2px;
        }

        /* SUPPLIER GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 18px;
            padding: 32px 28px;
            transition: transform 0.3s, border-color 0.3s, box-shadow 0.3s;
            animation: fadeUp 0.8s ease both;
        }

        .card:hover {
            transform: translateY(-6px);
            border-color: #9F5C44;
            box-shadow: 0 12px 30px rgba(0,0,0,0.5);
        }

        .card-icon {
            font-size: 2.2rem;
            margin-bottom: 18px;
        }

        .card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: #c47a5a;
            margin-bottom: 12px;
        }

        .card p {
            color: #8a7060;
            font-size: 0.9rem;
            line-height: 1.8;
            font-weight: 300;
        }

        .card-tag {
            display: inline-block;
            margin-top: 16px;
            background: rgba(159,92,68,0.12);
            border: 1px solid rgba(159,92,68,0.25);
            color: #c47a5a;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* CTA STRIP */
        .cta-strip {
            background: rgba(159,92,68,0.08);
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 18px;
            padding: 44px 32px;
            text-align: center;
            animation: fadeUp 1s ease both;
        }

        .cta-strip h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #f0e6df;
            margin-bottom: 12px;
        }

        .cta-strip p {
            color: #8a7060;
            font-size: 0.95rem;
            font-weight: 300;
            margin-bottom: 28px;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #9F5C44, #c47a5a);
            color: #fff;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: opacity 0.2s, transform 0.2s;
        }
        .cta-btn:hover { opacity: 0.9; transform: translateY(-2px); color: #fff; }

        /* FOOTER */
        .footer { text-align: center; margin-top: 48px; color: #4a3a30; font-size: 0.85rem; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .hero h1 { font-size: 2rem; }
            .cta-strip { padding: 32px 20px; }
        }
    </style>
</head>
<body>
<div class="container">

    <a href="index.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <!-- HERO -->
    <div class="hero">
        <div class="badge">✦ Our Supply Chain</div>
        <h1>Trusted <span>Suppliers</span></h1>
        <div class="divider"></div>
        <p>We partner with premium suppliers to bring you the finest ingredients — from bean to cup, every step is quality-assured.</p>
    </div>

    <!-- SUPPLIER CARDS -->
    <div class="grid">

        <div class="card">
            <div class="card-icon">☕</div>
            <h3>Organic Coffee Farms</h3>
            <p>We source our beans from certified organic farms across Ethiopia, Colombia, and Brazil — carefully selected for rich aroma and full-bodied flavor.</p>
            <span class="card-tag">Sourcing</span>
        </div>

        <div class="card">
            <div class="card-icon">🥛</div>
            <h3>Milk & Dairy Suppliers</h3>
            <p>Our dairy partners provide fresh, locally sourced milk and cream that give our drinks their smooth, creamy texture and consistent quality.</p>
            <span class="card-tag">Dairy</span>
        </div>

        <div class="card">
            <div class="card-icon">📦</div>
            <h3>Packaging Providers</h3>
            <p>We use eco-friendly, sustainable packaging materials from certified providers who share our commitment to reducing environmental impact.</p>
            <span class="card-tag">Sustainability</span>
        </div>

        <div class="card">
            <div class="card-icon">🍫</div>
            <h3>Flavor & Syrup Suppliers</h3>
            <p>Premium syrups, sauces, and flavor concentrates sourced from trusted artisan producers to craft our signature specialty drinks.</p>
            <span class="card-tag">Flavors</span>
        </div>

        <div class="card">
            <div class="card-icon">⚙️</div>
            <h3>Equipment Providers</h3>
            <p>Industry-leading brewing equipment and machines supplied by manufacturers who prioritize precision, durability, and consistency in every brew.</p>
            <span class="card-tag">Equipment</span>
        </div>

        <div class="card">
            <div class="card-icon">🌾</div>
            <h3>Local Food Producers</h3>
            <p>Fresh ingredients for our food menu come from nearby local farms and producers — supporting the community while keeping quality at its peak.</p>
            <span class="card-tag">Local</span>
        </div>

    </div>

    <!-- CTA -->
    <div class="cta-strip">
        <h2>Become a Supplier</h2>
        <p>We're always looking for quality partners who share our standards. Reach out and let's grow together.</p>
        <a href="partnership.php" class="cta-btn">
            <i class="fas fa-handshake"></i> Apply as a Supplier
        </a>
    </div>

    <div class="footer">
        © 2026 Baresto Brewed Coffee | All Rights Reserved
    </div>

</div>
</body>
</html>