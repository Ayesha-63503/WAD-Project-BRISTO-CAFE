<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partnership - Baresto</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">

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

        .container { max-width: 720px; margin: 0 auto; }

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

        .hero { text-align: center; margin-bottom: 52px; animation: fadeUp 0.7s ease both; }

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
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .divider {
            width: 60px; height: 2px;
            background: linear-gradient(to right, #9F5C44, #c47a5a);
            margin: 24px auto; border-radius: 2px;
        }

        .form-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 18px;
            padding: 44px 40px;
            animation: fadeUp 0.9s ease both;
        }

        .form-group { margin-bottom: 24px; }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: #c47a5a;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 14px 16px;
            color: #f0e6df;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.2s, background 0.2s;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder { color: #555; }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #9F5C44;
            background: rgba(159,92,68,0.07);
            outline: none;
        }

        .form-group select option { background: #1a1a1a; color: #f0e6df; }
        .form-group textarea { resize: vertical; min-height: 140px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #9F5C44, #c47a5a);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 8px;
            transition: opacity 0.2s, transform 0.2s;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-2px); }

        .footer { text-align: center; margin-top: 48px; color: #4a3a30; font-size: 0.85rem; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
            .form-card { padding: 28px 20px; }
            .hero h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
<div class="container">

    <a href="index.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <div class="hero">
        <div class="badge">✦ Collaborate With Us</div>
        <h1>Let's <span>Partner</span></h1>
        <div class="divider"></div>
        <p>We're always open to meaningful collaborations. Fill out the form and we'll get back to you shortly.</p>
    </div>

    <div class="form-card">
        <form action="https://formspree.io/f/mreryjkd" method="POST">

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g. Juan dela Cruz" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
            </div>

            <div class="form-group">
                <label for="company">Company / Organization</label>
                <input type="text" id="company" name="company" placeholder="Your business name">
            </div>

            <div class="form-group">
                <label for="type">Partnership Type</label>
                <select id="type" name="partnership_type">
                    <option value="" disabled selected>Select a type...</option>
                    <option>Supplier / Ingredient Partner</option>
                    <option>Equipment Provider</option>
                    <option>Marketing / Sponsorship</option>
                    <option>Event Collaboration</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="proposal">Your Proposal</label>
                <textarea id="proposal" name="proposal" placeholder="Tell us about your idea and what you'd like to achieve together..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-handshake" style="margin-right:8px;"></i> Submit Proposal
            </button>

        </form>
    </div>

    <div class="footer">
        © 2026 Baresto Brewed Coffee | All Rights Reserved
    </div>

</div>
</body>
</html>