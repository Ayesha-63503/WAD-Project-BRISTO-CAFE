<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Update status
if (isset($_GET['update_id']) && isset($_GET['new_status'])) {
    $id     = (int)$_GET['update_id'];
    $status = mysqli_real_escape_string($conn, $_GET['new_status']);
    $allowed = ['pending', 'processing', 'completed', 'cancelled'];
    if (in_array($status, $allowed)) {
        mysqli_query($conn, "UPDATE orders SET status='$status' WHERE order_id=$id");
    }
    $filter = $_GET['filter'] ?? 'all';
    header("Location: orders.php?filter=$filter");
    exit;
}

// Filter
$filter = $_GET['filter'] ?? 'all';
$where  = ($filter !== 'all') ? "WHERE status='" . mysqli_real_escape_string($conn, $filter) . "'" : "";

$orders    = mysqli_query($conn, "SELECT * FROM orders $where ORDER BY order_id DESC");
$total     = mysqli_num_rows(mysqli_query($conn, "SELECT order_id FROM orders"));
$pending   = mysqli_num_rows(mysqli_query($conn, "SELECT order_id FROM orders WHERE status='pending'"));
$processing= mysqli_num_rows(mysqli_query($conn, "SELECT order_id FROM orders WHERE status='processing'"));
$completed = mysqli_num_rows(mysqli_query($conn, "SELECT order_id FROM orders WHERE status='completed'"));
$cancelled = mysqli_num_rows(mysqli_query($conn, "SELECT order_id FROM orders WHERE status='cancelled'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        .container { max-width: 1200px; margin: 0 auto; }

        /* HEADER */
        .page-header {
            display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 36px;
        }
        .page-header h1 { font-family: 'Playfair Display', serif; font-size: 2rem; }
        .page-header a { color: #9F5C44; text-decoration: none; font-size: 0.9rem; }
        .page-header a:hover { text-decoration: underline; }

        /* STATS */
        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px; margin-bottom: 28px;
        }
        .stat {
            background: #1a1410;
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 14px; padding: 18px;
            text-align: center; text-decoration: none;
            display: block; transition: 0.2s;
        }
        .stat:hover, .stat.active { border-color: #9F5C44; background: rgba(159,92,68,0.08); }
        .stat .num  { font-size: 1.8rem; font-weight: 600; }
        .stat .lbl  { font-size: 0.78rem; color: #8a7060; margin-top: 4px; }
        .num-all       { color: #c47a5a; }
        .num-pending   { color: #ffc107; }
        .num-processing{ color: #64b5f6; }
        .num-completed { color: #81c784; }
        .num-cancelled { color: #e57373; }

        /* TABLE */
        .table-wrap {
            background: #1a1410;
            border: 1px solid rgba(159,92,68,0.2);
            border-radius: 18px; overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: rgba(159,92,68,0.15); }
        th {
            padding: 14px 16px; text-align: left;
            font-size: 0.75rem; font-weight: 600;
            color: #c47a5a; letter-spacing: 1px; text-transform: uppercase;
        }
        td {
            padding: 14px 16px; font-size: 0.87rem;
            border-top: 1px solid rgba(255,255,255,0.04);
            color: #d0b8a8; vertical-align: middle;
        }
        tr:hover td { background: rgba(159,92,68,0.04); }

        /* BADGE */
        .badge {
            padding: 4px 12px; border-radius: 20px;
            font-size: 0.73rem; font-weight: 500; display: inline-block;
        }
        .badge.pending    { background: rgba(255,193,7,0.15);  color: #ffc107; border: 1px solid rgba(255,193,7,0.3); }
        .badge.processing { background: rgba(100,181,246,0.15);color: #64b5f6; border: 1px solid rgba(100,181,246,0.3); }
        .badge.completed  { background: rgba(76,175,80,0.15);  color: #81c784; border: 1px solid rgba(76,175,80,0.3); }
        .badge.cancelled  { background: rgba(231,76,60,0.15);  color: #e57373; border: 1px solid rgba(231,76,60,0.3); }

        /* DROPDOWN */
        .status-form select {
            background: #110e0b;
            border: 1px solid rgba(159,92,68,0.3);
            color: #f0e6df;
            padding: 7px 12px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.82rem;
            cursor: pointer;
            outline: none;
        }
        .status-form select:focus { border-color: #9F5C44; }
        .status-form button {
            padding: 7px 14px;
            background: linear-gradient(135deg, #9F5C44, #c47a5a);
            color: #fff; border: none; border-radius: 8px;
            font-size: 0.82rem; font-family: 'Poppins', sans-serif;
            cursor: pointer; margin-left: 6px;
            transition: opacity 0.2s;
        }
        .status-form button:hover { opacity: 0.85; }

        /* ITEMS */
        .items-list { font-size: 0.8rem; color: #8a7060; line-height: 1.7; }

        .empty { text-align: center; padding: 60px; color: #4a3728; }

        @media (max-width: 768px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
            table { display: block; overflow-x: auto; }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>🧾 Manage Orders</h1>
        <a href="dashboard.php"><i class="fas fa-arrow-left" style="margin-right:6px;"></i>Back to Dashboard</a>
    </div>

    <!-- STATS / FILTER -->
    <div class="stats">
        <a href="orders.php?filter=all" class="stat <?php echo $filter=='all'?'active':''; ?>">
            <div class="num num-all"><?php echo $total; ?></div>
            <div class="lbl">All Orders</div>
        </a>
        <a href="orders.php?filter=pending" class="stat <?php echo $filter=='pending'?'active':''; ?>">
            <div class="num num-pending"><?php echo $pending; ?></div>
            <div class="lbl">Pending</div>
        </a>
        <a href="orders.php?filter=processing" class="stat <?php echo $filter=='processing'?'active':''; ?>">
            <div class="num num-processing"><?php echo $processing; ?></div>
            <div class="lbl">Processing</div>
        </a>
        <a href="orders.php?filter=completed" class="stat <?php echo $filter=='completed'?'active':''; ?>">
            <div class="num num-completed"><?php echo $completed; ?></div>
            <div class="lbl">Completed</div>
        </a>
        <a href="orders.php?filter=cancelled" class="stat <?php echo $filter=='cancelled'?'active':''; ?>">
            <div class="num num-cancelled"><?php echo $cancelled; ?></div>
            <div class="lbl">Cancelled</div>
        </a>
    </div>

    <!-- TABLE -->
    <div class="table-wrap">
        <?php if (mysqli_num_rows($orders) == 0): ?>
            <div class="empty">📭 No orders found.</div>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($orders)):
                $oid   = (int)$row['order_id'];
                $items = mysqli_query($conn, "SELECT product_name, quantity FROM order_items WHERE order_id=$oid");
                $itemList = [];
                while ($i = mysqli_fetch_assoc($items)) {
                    $itemList[] = htmlspecialchars($i['product_name']) . ' x' . $i['quantity'];
                }
            ?>
            <tr>
                <td><strong>#<?php echo $oid; ?></strong></td>
                <td><?php echo htmlspecialchars($row['customer_name'] ?? '—'); ?></td>
                <td><?php echo htmlspecialchars($row['phone'] ?? '—'); ?></td>
                <td><?php echo htmlspecialchars($row['address'] ?? '—'); ?></td>
                <td>
                    <div class="items-list">
                        <?php echo !empty($itemList) ? implode('<br>', $itemList) : '—'; ?>
                    </div>
                </td>
                <td><strong>Rs <?php echo number_format($row['total_amount'], 2); ?></strong></td>
                <td>
                    <span class="badge <?php echo $row['status']; ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </span>
                </td>
                <td>
                    <form class="status-form" method="GET" action="orders.php"
                          onsubmit="return confirm('Update this order status?')">
                        <input type="hidden" name="update_id" value="<?php echo $oid; ?>">
                        <input type="hidden" name="filter" value="<?php echo $filter; ?>">
                        <select name="new_status">
                            <option value="pending"    <?php echo $row['status']=='pending'    ?'selected':''; ?>>Pending</option>
                            <option value="processing" <?php echo $row['status']=='processing' ?'selected':''; ?>>Processing</option>
                            <option value="completed"  <?php echo $row['status']=='completed'  ?'selected':''; ?>>Completed</option>
                            <option value="cancelled"  <?php echo $row['status']=='cancelled'  ?'selected':''; ?>>Cancelled</option>
                        </select>
                        <button type="submit"><i class="fas fa-check"></i> Update</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>

</div>
</body>
</html>