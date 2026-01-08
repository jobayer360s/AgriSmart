<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/revenueModel.php');
require_once(__DIR__ . '/../models/orderModel.php');

$totalRevenue = getTotalRevenue();
$totalCost = getTotalCost();
$totalProfit = getTotalProfit();
$revenueData = getAllRevenue();

$pageTitle = "Revenue Report";
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
</div>

<div class="content-box">
    <h2>Revenue Breakdown</h2>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Revenue</th>
                    <th>Cost</th>
                    <th>Profit</th>
                    <th>Profit Margin</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($revenueData as $rev): ?>
                    <?php 
                        $profitMargin = ($rev['revenue'] > 0) ? ($rev['profit'] / $rev['revenue']) * 100 : 0;
                    ?>
                    <tr>
                        <td><strong><?php echo $rev['order_number']; ?></strong></td>
                        <td style="color: #007bff;">৳<?php echo number_format($rev['revenue'], 2); ?></td>
                        <td style="color: #dc3545;">৳<?php echo number_format($rev['cost'], 2); ?></td>
                        <td style="color: #28a745;">৳<?php echo number_format($rev['profit'], 2); ?></td>
                        <td><?php echo number_format($profitMargin, 1); ?>%</td>
                        <td><?php echo date('M d, Y', strtotime($rev['recorded_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="background: #f8f9fa; font-weight: bold;">
                    <td>TOTAL</td>
                    <td style="color: #007bff;">৳<?php echo number_format($totalRevenue, 2); ?></td>
                    <td style="color: #dc3545;">৳<?php echo number_format($totalCost, 2); ?></td>
                    <td style="color: #28a745;">৳<?php echo number_format($totalProfit, 2); ?></td>
                    <td><?php echo $totalRevenue > 0 ? number_format(($totalProfit/$totalRevenue)*100, 1) : 0; ?>%</td>
                    <td>-</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
