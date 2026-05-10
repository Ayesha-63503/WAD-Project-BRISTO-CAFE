<!DOCTYPE html>
<html>
<head>
    <title>Affiliates - Baresto</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: #0d0d0d;
            background-image:
                radial-gradient(ellipse at 10% 30%, rgba(159,92,68,0.12) 0%, transparent 55%),
                radial-gradient(ellipse at 90% 70%, rgba(101,55,38,0.1) 0%, transparent 50%);
            font-family: 'Poppins', sans-serif;
            color: #f0e6df;
            padding: 60px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* HERO */
        .hero {
            text-align: center;
            margin-bottom: 64px;
            animation: fadeUp 0.7s ease both;
        }

        .hero .badge {
            display: inline-block;
            background: rgba(159,92,68,0.15);
            border: 1px solid rgba(159,92,68,0.35);
            color: #c47a5a;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 18px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: #f0e6df;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .hero h1 span {
            font-style: italic;
            color: #c47a5a;
        }

        .hero p {
            color: #8a7060;
            font-size: 1rem;
            font-weight: 300;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .divider {
            width: 60px;
            height: 2px;
            background: linear-gradient(to right, #9F5C44, #c47a5a);
            margin: 28px auto;
            border-radius: 2px;
        }

        /* AFFILIATE CARDS */
        .affiliates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            margin-bottom: 64px;
        }

        .affiliate-card {
            background: #1a1410;
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 20px;
            padding: 32px 28px;
            transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s;
            animation: fadeUp 0.7s ease both;
            position: relative;
            overflow: hidden;
        }

        .affiliate-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(to right, #9F5C44, #c47a5a);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .affiliate-card:hover {
            border-color: rgba(159,92,68,0.5);
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .affiliate-card:hover::before {
            opacity: 1;
        }

        .affiliate-card:nth-child(1) { animation-delay: 0.1s; }
        .affiliate-card:nth-child(2) { animation-delay: 0.2s; }
        .affiliate-card:nth-child(3) { animation-delay: 0.3s; }

        .card-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, rgba(159,92,68,0.2), rgba(196,122,90,0.1));
            border: 1px solid rgba(159,92,68,0.3);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
        }

        .affiliate-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: #f0e6df;
            margin-bottom: 10px;
        }

        .affiliate-card p {
            color: #8a7060;
            font-size: 0.88rem;
            font-weight: 300;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .card-tag {
            display: inline-block;
            background: rgba(159,92,68,0.1);
            border: 1px solid rgba(159,92,68,0.25);
            color: #c47a5a;
            font-size: 0.72rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* PARTNER STRIP */
        .partner-strip {
            background: #1a1410;
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            animation: fadeUp 0.7s ease 0.4s both;
        }

        .partner-strip h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: #f0e6df;
            margin-bottom: 10px;
        }

        .partner-strip p {
            color: #8a7060;
            font-size: 0.9rem;
            font-weight: 300;
            margin-bottom: 28px;
        }

        .partner-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #9F5C44, #c47a5a);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 6px 20px rgba(159,92,68,0.4);
        }

        .partner-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(159,92,68,0.5);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* back link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #9F5C44;
            text-decoration: none;
            font-size: 0.88rem;
            margin-bottom: 40px;
            transition: gap 0.2s;
        }
        .back-link:hover { gap: 12px; }
    </style>
</head>
<body>

<div class="container">

    <a href="index.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <!-- HERO -->
    <div class="hero">
        <div class="badge">✦ Our Partners</div>
        <h1>Trusted <span>Affiliates</span></h1>
        <div class="divider"></div>
        <p>We collaborate with trusted partners to bring you the finest coffee experience — from bean to cup.</p>
    </div>

    <!-- CARDS -->
    <div class="affiliates-grid">

        <div class="affiliate-card">
            <div class="card-icon">☕</div>
            <h3>Coffee Bean Suppliers</h3>
            <p>We source our premium beans from certified growers across Ethiopia, Colombia, and Brazil — ensuring every cup is exceptional.</p>
            <span class="card-tag">Sourcing</span>
        </div>

        <div class="affiliate-card">
            <div class="card-icon">⚙️</div>
            <h3>Equipment Providers</h3>
            <p>Our machines and brewing tools are provided by industry-leading manufacturers who share our passion for precision and quality.</p>
            <span class="card-tag">Technology</span>
        </div>

        <div class="affiliate-card">
            <div class="card-icon">🌾</div>
            <h3>Local Farmers</h3>
            <p>We proudly support local agriculture by partnering with nearby farms that supply fresh ingredients for our food and specialty drinks.</p>
            <span class="card-tag">Local</span>
        </div>

    </div>

    <!-- PARTNER CTA -->
    <div class="partner-strip">
        <h2>Want to become a partner?</h2>
        <p>We're always open to new collaborations that align with our values.</p>
        <a href="contact.php" class="partner-btn">
            <i class="fas fa-handshake"></i>
            Get in Touch
        </a>
    </div>

</div>

</body>
</html>