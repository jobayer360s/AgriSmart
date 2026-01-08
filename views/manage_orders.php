<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/orderModel.php');
$orders = getAllOrders();

$pageTitle = "Manage Orders";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>All Orders (<?php echo count($orders); ?>)</h2>
</div>

<div class="content-box">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Farmer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><strong><?php echo $order['order_number']; ?></strong></td>
                        <td><?php echo htmlspecialchars($order['farmer_name']); ?></td>
                        <td>৳<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td>
                            <select id="status_<?php echo $order['id']; ?>" onchange="updateOrderStatus(<?php echo $order['id']; ?>)">
                                <option value="pending" <?php echo $order['status']=='pending'?'selected':''; ?>>Pending</option>
                                <option value="processing" <?php echo $order['status']=='processing'?'selected':''; ?>>Processing</option>
                                <option value="shipped" <?php echo $order['status']=='shipped'?'selected':''; ?>>Shipped</option>
                                <option value="delivered" <?php echo $order['status']=='delivered'?'selected':''; ?>>Delivered</option>
                                <option value="cancelled" <?php echo $order['status']=='cancelled'?'selected':''; ?>>Cancelled</option>
                            </select>
                            <div id="statusDisplay_<?php echo $order['id']; ?>" style="font-size: 0.85em; margin-top: 5px;"></div>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                        <td>
                            <a href="view_order.php?id=<?php echo $order['id']; ?>" class="btn-small">View Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
