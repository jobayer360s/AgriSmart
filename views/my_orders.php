<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/orderModel.php');
$orders = getOrdersByFarmer($_SESSION['user_id']);

$pageTitle = "My Orders";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Order placed successfully! Order Number: <?php echo $_GET['order_num']; ?></div>
<?php endif; ?>

<div class="content-box">
    <h2>My Orders (<?php echo count($orders); ?>)</h2>
</div>

<?php if(count($orders) > 0): ?>
    <div class="content-box">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td><strong><?php echo $order['order_number']; ?></strong></td>
                            <td>৳<?php echo number_format($order['total_amount'], 2); ?></td>
                            <td>
                                <span class="status-<?php echo $order['status']; ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M d, Y h:i A', strtotime($order['created_at'])); ?></td>
                            <td>
                                <a href="view_my_order.php?id=<?php echo $order['id']; ?>" class="btn-small">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 4em;">📦</div>
            <h2>No orders yet</h2>
            <p>Start shopping to place your first order</p>
            <a href="shop.php" class="btn">Go to Shop</a>
        </div>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
