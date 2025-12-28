<?php
// Require login
if (!$auth->isLoggedIn()) {
    header('Location: index.php?page=auth');
    exit;
}

$user = $auth->getCurrentUser();
$stats = $marketplace->getStats();
$userOrders = $marketplace->getUserOrders($user['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AgriSmart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2ecc71;
            --secondary: #27ae60;
            --dark: #2c3e50;
            --light: #ecf0f1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .logout-btn {
            background: white;
            color: var(--primary);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .welcome {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .welcome h1 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .role-badge {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary);
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
            margin-top: 0.5rem;
        }

        .orders-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .orders-section h2 {
            color: var(--dark);
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f0f0f0;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid var(--primary);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:hover {
            background: #f9f9f9;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #cfe2ff;
            color: #084298;
        }

        .status-delivered {
            background: #d1e7dd;
            color: #0f5132;
        }

        .empty-message {
            text-align: center;
            color: #7f8c8d;
            padding: 2rem;
        }

        .action-links {
            display: flex;
            gap: 1rem;
        }

        .action-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="nav-brand">🌾 AgriSmart</a>
        <ul class="nav-links">
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=marketplace">Marketplace</a></li>
            <li><a href="index.php?page=orders">Orders</a></li>
            <li>
                <a href="index.php?page=logout" class="logout-btn">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome">
            <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>! 👋</h1>
            <p>Your Account</p>
            <span class="role-badge"><?php echo ucfirst($user['role']); ?></span>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Products</div>
                <div class="stat-value"><?php echo $stats['total_products']; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Orders</div>
                <div class="stat-value"><?php echo $stats['total_orders']; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value">৳<?php echo number_format($stats['total_revenue'], 0); ?></div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="orders-section">
            <h2>📦 Your Orders</h2>

            <?php if (empty($userOrders)): ?>
                <div class="empty-message">
                    <p>No orders yet. <a href="index.php?page=marketplace" style="color: var(--primary);">Browse marketplace</a></p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userOrders as $order): ?>
                            <tr>
                                <td>#<?php echo substr($order['id'], -6); ?></td>
                                <td><?php echo htmlspecialchars($order['createdAt']); ?></td>
                                <td><?php echo count($order['items']); ?> items</td>
                                <td>৳<?php echo number_format($order['total'], 0); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $order['status']; ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
