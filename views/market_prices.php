<?php
require_once('../controllers/authCheck.php');
require_once(__DIR__ . '/../models/marketModel.php');

$prices = getAllMarketPrices();

$pageTitle = "Market Prices";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Current Market Prices</h2>
    <p>Latest crop prices from different markets in Bangladesh</p>
</div>

<?php if(count($prices) > 0): ?>
    <div class="content-box">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Crop Name</th>
                        <th>Price (per kg)</th>
                        <th>Location</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($prices as $price): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($price['crop_name']); ?></strong></td>
                            <td style="color: #28a745; font-weight: bold;">৳<?php echo number_format($price['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($price['location']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($price['date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <p>No market price data available.</p>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
