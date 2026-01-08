<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/userModel.php');
require_once(__DIR__ . '/../models/shopProductModel.php');
require_once(__DIR__ . '/../models/orderModel.php');
require_once(__DIR__ . '/../models/revenueModel.php');

$users = getAllUsers();
$products = getAllShopProducts();
$orders = getAllOrders();

$totalRevenue = getTotalRevenue();
$totalCost = getTotalCost();
$totalProfit = getTotalProfit();

$pageTitle = "Admin Dashboard";
include('../assets/includes/header.php');
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-content">
            <h3>৳<?php echo number_format($totalRevenue, 2); ?></h3>
            <p>Total Revenue</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">📉</div>
        <div class="stat-content">
            <h3>৳<?php echo number_format($totalCost, 2); ?></h3>
            <p>Total Cost</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">📈</div>
        <div class="stat-content">
            <h3>৳<?php echo number_format($totalProfit, 2); ?></h3>
            <p>Total Profit</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-content">
            <h3><?php echo count($users); ?></h3>
            <p>Total Users</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">📦</div>
        <div class="stat-content">
            <h3><?php echo count($products); ?></h3>
            <p>Shop Products</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">🛒</div>
        <div class="stat-content">
            <h3><?php echo count($orders); ?></h3>
            <p>Total Orders</p>
        </div>
    </div>
</div>

<div class="content-box">
    <h2>Quick Actions</h2>
    <div class="action-grid">
        <a href="manage_products.php" class="action-btn">Manage Products</a>
        <a href="manage_orders.php" class="action-btn">Manage Orders</a>
        <a href="manage_users.php" class="action-btn">Manage Users</a>
        <a href="manage_tips.php" class="action-btn">Manage Tips</a>
        <a href="manage_weather.php" class="action-btn">Manage Weather</a>
        <a href="revenue_report.php" class="action-btn">Revenue Report</a>
    </div>
</div>

<div class="content-box">
    <h2>Recent Orders</h2>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Farmer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(array_slice($orders, 0, 5) as $order): ?>
                    <tr>
                        <td><?php echo $order['order_number']; ?></td>
                        <td><?php echo htmlspecialchars($order['farmer_name']); ?></td>
                        <td>৳<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><span class="status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></td>
                        <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
