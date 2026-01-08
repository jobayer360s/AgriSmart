<?php
session_start();
require_once(__DIR__ . '/../models/orderModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];
    
    if(updateOrderStatus($orderId, $status)) {
        // Notify farmer
        $order = getOrderById($orderId);
        createNotification($order['farmer_id'], 'order', 'Order Status Updated', 
            'Your order #' . $order['order_number'] . ' is now ' . $status, 
            'view_my_order.php?id=' . $orderId);
        
        echo 'success';
    } else {
        echo 'failed';
    }
}
?>
