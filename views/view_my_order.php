<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/orderModel.php');

if(!isset($_GET['id'])){
    header('location: my_orders.php');
    exit;
}

$order = getOrderById($_GET['id']);
$items = getOrderItems($_GET['id']);

if(!$order || $order['farmer_id'] != $_SESSION['user_id']){
    header('location: my_orders.php?error=not_found');
    exit;
}

$pageTitle = "Order Details";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <div class="box-header">
        <h2>Order Details: <?php echo $order['order_number']; ?></h2>
        <a href="my_orders.php" class="btn btn-secondary">Back to Orders</a>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 20px;">
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
                    <td><strong>Total Amount:</strong></td>
                    <td><strong style="color: #28a745; font-size: 1.2em;">৳<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                </tr>
            </table>
        </div>
        
        <div>
            <h3>Delivery Information</h3>
            <table class="info-table">
                <tr>
                    <td><strong>Delivery Address:</strong></td>
                    <td><?php echo nl2br(htmlspecialchars($order['delivery_address'])); ?></td>
                </tr>
                <tr>
                    <td><strong>Payment Method:</strong></td>
                    <td><?php echo ucfirst(str_replace('_', ' ', $order['payment_method'])); ?></td>
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
    <h3>Order Tracking</h3>
    <div style="padding: 20px;">
        <?php
        $statuses = ['pending' => 'Order Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered'];
        $currentIndex = array_search($order['status'], array_keys($statuses));
        ?>
        <div style="display: flex; justify-content: space-between; position: relative;">
            <?php foreach($statuses as $key => $label): ?>
                <?php 
                    $index = array_search($key, array_keys($statuses));
                    $isActive = $index <= $currentIndex;
                ?>
                <div style="flex: 1; text-align: center;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: <?php echo $isActive ? '#28a745' : '#e0e0e0'; ?>; color: white; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 10px;">
                        <?php echo $index + 1; ?>
                    </div>
                    <p style="font-size: 0.9em; color: <?php echo $isActive ? '#28a745' : '#666'; ?>;"><?php echo $label; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
