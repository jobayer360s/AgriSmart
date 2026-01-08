<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/orderModel.php');

if(!isset($_GET['id'])){
    header('location: manage_orders.php');
    exit;
}

$order = getOrderById($_GET['id']);
$items = getOrderItems($_GET['id']);

if(!$order){
    header('location: manage_orders.php?error=not_found');
    exit;
}

$pageTitle = "Order Details";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <div class="box-header">
        <h2>Order Details: <?php echo $order['order_number']; ?></h2>
        <a href="manage_orders.php" class="btn btn-secondary">Back to Orders</a>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 20px;">
        <div>
            <h3>Customer Information</h3>
            <table class="info-table">
                <tr>
                    <td><strong>Farmer Name:</strong></td>
                    <td><?php echo htmlspecialchars($order['farmer_name']); ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?php echo htmlspecialchars($order['farmer_email']); ?></td>
                </tr>
                <tr>
                    <td><strong>Delivery Address:</strong></td>
                    <td><?php echo nl2br(htmlspecialchars($order['delivery_address'])); ?></td>
                </tr>
            </table>
        </div>
        
        <div>
            <h3>Order Information</h3>
            <table class="info-table">
                <tr>
                    <td><strong>Order Number:</strong></td>
                    <td><?php echo $order['order_number']; ?></td>
                </tr>
                <tr>
                    <td><strong>Order Date:</strong></td>
                    <td><?php echo date('M d, Y h:i A', strtotime($order['created_at'])); ?></td>
                </tr>
                <tr>
                    <td><strong>Status:</strong></td>
                    <td><span class="status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Payment Method:</strong></td>
                    <td><?php echo ucfirst(str_replace('_', ' ', $order['payment_method'])); ?></td>
                </tr>
                <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td><strong style="color: #28a745; font-size: 1.2em;">৳<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="content-box">
    <h3>Order Items</h3>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>৳<?php echo number_format($item['price'], 2); ?></td>
                        <td>৳<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                    <td><strong>৳<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="content-box">
    <h3>Update Order Status</h3>
    <div class="form-style">
        <div class="form-group">
            <label>Change Status:</label>
            <select id="status_<?php echo $order['id']; ?>">
                <option value="pending" <?php echo $order['status']=='pending'?'selected':''; ?>>Pending</option>
                <option value="processing" <?php echo $order['status']=='processing'?'selected':''; ?>>Processing</option>
                <option value="shipped" <?php echo $order['status']=='shipped'?'selected':''; ?>>Shipped</option>
                <option value="delivered" <?php echo $order['status']=='delivered'?'selected':''; ?>>Delivered</option>
                <option value="cancelled" <?php echo $order['status']=='cancelled'?'selected':''; ?>>Cancelled</option>
            </select>
        </div>
        <button onclick="updateOrderStatus(<?php echo $order['id']; ?>)" class="btn">Update Status</button>
        <div id="statusDisplay_<?php echo $order['id']; ?>" style="margin-top: 10px; font-weight: 600;"></div>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
