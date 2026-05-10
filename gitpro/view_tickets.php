<?php
include '../config/db.php';
session_start();

// Only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../users/login.php");
    exit();
}

// Mark ticket as resolved
if (isset($_GET['resolve'])) {
    $id = (int)$_GET['resolve'];
    mysqli_query($conn, "UPDATE tickets SET status='resolved' WHERE ticket_id=$id");
    header("Location: view_tickets.php");
    exit();
}

// Delete ticket
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM tickets WHERE ticket_id=$id");
    header("Location: view_tickets.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM tickets ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tickets - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: #0d0d0d;
            background-image: radial-gradient(ellipse at 20% 50%, rgba(159,92,68,0.1) 0%, transparent 60%);
            font-family: 'Poppins', sans-serif;
            color: #f0e6df;
            padding: 40px 20px;
        }
        .container { max-width: 1000px; margin: 0 auto; }
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 36px;
        }
        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; color: #f0e6df;
        }
        .page-header a {
            color: #9F5C44; text-decoration: none; font-size: 0.9rem;
        }
        .page-header a:hover { text-decoration: underline; }
        .stats {
            display: flex; gap: 16px; margin-bottom: 30px;
        }
        .stat-card {
            flex: 1; background: #1a1410;
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 16px; padding: 20px; text-align: center;
        }
        .stat-card .number { font-size: 2rem; font-weight: 600; color: #c47a5a; }
        .stat-card .label { font-size: 0.8rem; color: #8a7060; margin-top: 4px; }
        .ticket-card {
            background: #1a1410;
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 16px; padding: 24px;
            margin-bottom: 16px;
            transition: border-color 0.3s;
        }
        .ticket-card:hover { border-color: rgba(159,92,68,0.5); }
        .ticket-card.resolved { opacity: 0.6; }
        .ticket-top {
            display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 12px;
        }
        .ticket-info h3 { font-size: 1rem; color: #f0e6df; margin-bottom: 4px; }
        .ticket-info p { font-size: 0.82rem; color: #8a7060; }
        .badge {
            padding: 4px 12px; border-radius: 20px;
            font-size: 0.75rem; font-weight: 500;
        }
        .badge.pending { background: rgba(255,193,7,0.15); color: #ffc107; border: 1px solid rgba(255,193,7,0.3); }
        .badge.resolved { background: rgba(76,175,80,0.15); color: #81c784; border: 1px solid rgba(76,175,80,0.3); }
        .ticket-issue {
            background: #110e0b; border-radius: 10px;
            padding: 14px; color: #c4a090;
            font-size: 0.9rem; line-height: 1.6;
            margin-bottom: 16px;
        }
        .ticket-actions { display: flex; gap: 10px; }
        .btn {
            padding: 8px 18px; border-radius: 8px;
            font-size: 0.82rem; font-weight: 500;
            text-decoration: none; cursor: pointer;
            border: none; font-family: 'Poppins', sans-serif;
            display: inline-flex; align-items: center; gap: 6px;
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn:hover { opacity: 0.85; transform: translateY(-1px); }
        .btn-resolve { background: rgba(76,175,80,0.2); color: #81c784; border: 1px solid rgba(76,175,80,0.3); }
        .btn-delete  { background: rgba(231,76,60,0.2);  color: #e57373; border: 1px solid rgba(231,76,60,0.3); }
        .empty {
            text-align: center; padding: 60px;
            color: #4a3728; font-size: 1rem;
        }
        .ticket-date { font-size: 0.78rem; color: #5a3d2e; margin-top: 4px; }
    </style>
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>🎫 Support Tickets</h1>
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>

    <?php
    // Count stats
    $total    = mysqli_num_rows($result);
    $pending  = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tickets WHERE status='pending'"));
    $resolved = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tickets WHERE status='resolved'"));
    mysqli_data_seek($result, 0);
    ?>

    <div class="stats">
        <div class="stat-card">
            <div class="number"><?php echo $total; ?></div>
            <div class="label">Total Tickets</div>
        </div>
        <div class="stat-card">
            <div class="number" style="color:#ffc107"><?php echo $pending; ?></div>
            <div class="label">Pending</div>
        </div>
        <div class="stat-card">
            <div class="number" style="color:#81c784"><?php echo $resolved; ?></div>
            <div class="label">Resolved</div>
        </div>
    </div>

    <?php if ($total == 0): ?>
        <div class="empty">🎉 No tickets submitted yet!</div>
    <?php else: ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="ticket-card <?php echo $row['status']; ?>">
            <div class="ticket-top">
                <div class="ticket-info">
                    <h3><i class="fas fa-user" style="color:#9F5C44; margin-right:6px;"></i><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><i class="fas fa-envelope" style="margin-right:6px;"></i><?php echo htmlspecialchars($row['email']); ?></p>
                    <p class="ticket-date"><i class="fas fa-clock" style="margin-right:6px;"></i><?php echo $row['created_at']; ?></p>
                </div>
                <span class="badge <?php echo $row['status']; ?>"><?php echo ucfirst($row['status']); ?></span>
            </div>

            <div class="ticket-issue">
                <?php echo nl2br(htmlspecialchars($row['issue'])); ?>
            </div>

            <div class="ticket-actions">
                <?php if ($row['status'] == 'pending'): ?>
                <a href="?resolve=<?php echo $row['ticket_id']; ?>" class="btn btn-resolve">
                    <i class="fas fa-check"></i> Mark Resolved
                </a>
                <?php endif; ?>
                <a href="?delete=<?php echo $row['ticket_id']; ?>"
                   class="btn btn-delete"
                   onclick="return confirm('Delete this ticket?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>
</body>
</html>