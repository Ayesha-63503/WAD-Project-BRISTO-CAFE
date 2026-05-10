<?php
include 'config/db.php';
session_start();

$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $issue = mysqli_real_escape_string($conn, $_POST['issue']);

    if (!empty($name) && !empty($email) && !empty($issue)) {
        $query = "INSERT INTO tickets (name, email, issue) VALUES ('$name', '$email', '$issue')";
        if (mysqli_query($conn, $query)) {
            $success = true;
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit a Ticket - Baresto</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: #0d0d0d;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(159,92,68,0.15) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(101,55,38,0.1) 0%, transparent 50%);
            display: flex; align-items: center; justify-content: center;
            padding: 40px 20px; font-family: 'Poppins', sans-serif;
        }
        .ticket-wrapper { width: 100%; max-width: 540px; animation: fadeUp 0.7s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .ticket-header { text-align: center; margin-bottom: 36px; }
        .ticket-header .icon {
            display: inline-flex; align-items: center; justify-content: center;
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #9F5C44, #c47a5a);
            border-radius: 18px; font-size: 1.8rem; color: #fff;
            margin-bottom: 16px; box-shadow: 0 8px 24px rgba(159,92,68,0.4);
        }
        .ticket-header h1 { font-family: 'Playfair Display', serif; font-size: 2.2rem; color: #f0e6df; margin-bottom: 8px; }
        .ticket-header p { color: #8a7060; font-size: 0.95rem; font-weight: 300; }
        .ticket-card {
            background: #1a1410; border: 1px solid rgba(159,92,68,0.2);
            border-radius: 24px; padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.05);
        }
        .alert-success {
            background: rgba(76,175,80,0.1); border: 1px solid rgba(76,175,80,0.3);
            border-radius: 12px; padding: 16px; color: #81c784;
            font-size: 0.9rem; text-align: center; margin-bottom: 20px;
        }
        .alert-error {
            background: rgba(231,76,60,0.1); border: 1px solid rgba(231,76,60,0.3);
            border-radius: 12px; padding: 16px; color: #e57373;
            font-size: 0.9rem; text-align: center; margin-bottom: 20px;
        }
        .form-group { margin-bottom: 24px; }
        label { display: block; color: #c4a090; font-size: 0.82rem; font-weight: 500; letter-spacing: 1.2px; text-transform: uppercase; margin-bottom: 10px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #5a3d2e; font-size: 0.95rem; transition: color 0.3s; }
        .input-wrap.textarea-wrap i { top: 18px; transform: none; }
        input, textarea {
            width: 100%; background: #110e0b; border: 1px solid rgba(159,92,68,0.2);
            border-radius: 12px; padding: 14px 16px 14px 44px; color: #f0e6df;
            font-family: 'Poppins', sans-serif; font-size: 0.95rem; font-weight: 300;
            transition: border-color 0.3s, box-shadow 0.3s; outline: none;
        }
        textarea { resize: vertical; min-height: 130px; line-height: 1.6; }
        input::placeholder, textarea::placeholder { color: #3d2e25; }
        input:focus, textarea:focus { border-color: #9F5C44; box-shadow: 0 0 0 3px rgba(159,92,68,0.15); }
        .input-wrap:focus-within i { color: #9F5C44; }
        .divider { height: 1px; background: linear-gradient(to right, transparent, rgba(159,92,68,0.3), transparent); margin: 28px 0; }
        .submit-btn {
            width: 100%; padding: 16px; background: linear-gradient(135deg, #9F5C44, #c47a5a);
            border: none; border-radius: 12px; color: #fff; font-family: 'Poppins', sans-serif;
            font-size: 1rem; font-weight: 500; cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 6px 20px rgba(159,92,68,0.4);
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(159,92,68,0.5); }
        .footer-note { text-align: center; margin-top: 20px; color: #4a3728; font-size: 0.82rem; }
        .footer-note a { color: #9F5C44; text-decoration: none; }
        .back-link { display: inline-block; margin-bottom: 24px; color: #9F5C44; text-decoration: none; font-size: 0.9rem; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="ticket-wrapper">
    <div class="ticket-header">
        <div class="icon">🎫</div>
        <h1>Submit a Ticket</h1>
        <p>We'll get back to you as soon as possible</p>
    </div>
    <div class="ticket-card">
        <?php if ($success): ?>
            <div class="alert-success">
                ✅ Your ticket has been submitted successfully! We'll get back to you soon.
            </div>
            <a href="ticket.php" class="back-link">← Submit another ticket</a>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="alert-error">❌ <?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Your Name</label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="e.g. Bareen Khan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="e.g. bareen@email.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Describe Your Issue</label>
                    <div class="input-wrap textarea-wrap">
                        <i class="fas fa-comment-alt"></i>
                        <textarea name="issue" placeholder="Please describe your issue in detail..." required></textarea>
                    </div>
                </div>
                <div class="divider"></div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Ticket
                </button>
            </form>
        <?php endif; ?>
    </div>
    <p class="footer-note">Need urgent help? <a href="mailto:support@baresto.com">Email us directly</a></p>
</div>
</body>
</html>