<?php
session_start();
require_once(__DIR__ . '/../models/orderModel.php');
require_once(__DIR__ . '/../models/cartModel.php');
require_once(__DIR__ . '/../models/shopProductModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $address = trim($_POST['address']);
    $cartItems = getCartItems($_SESSION['user_id']);
    $total = getCartTotal($_SESSION['user_id']);
    
    if(count($cartItems) == 0) {
        header('location: ../views/cart.php');
        exit;
    }
    
    // Generate order number
    $orderNumber = 'ORD-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    
    // Create order
    $orderId = createOrder($orderNumber, $_SESSION['user_id'], $total, $address);
    
    if($orderId) {
        // Add order items
        foreach($cartItems as $item) {
            addOrderItem($orderId, $item['product_id'], $item['name'], $item['quantity'], $item['price']);
            // Update stock
            updateStock($item['product_id'], $item['quantity']);
        }
        
        // Clear cart
        clearCart($_SESSION['user_id']);
        
        // Notify admin
        $adminStmt = $GLOBALS['conn']->query("SELECT id FROM users WHERE role = 'admin'");
        while($admin = $adminStmt->fetch(PDO::FETCH_ASSOC)) {
            createNotification($admin['id'], 'order', 'New Order Received', 
                'Farmer ' . $_SESSION['username'] . ' placed order #' . $orderNumber, 
                'manage_orders.php');
        }
        $managementStmt = $GLOBALS['conn']->query("SELECT id FROM users WHERE role = 'management'");
        while($management = $managementStmt->fetch(PDO::FETCH_ASSOC)) {
            createNotification($management['id'], 'order', 'New Order Received', 
                'Farmer ' . $_SESSION['username'] . ' placed order #' . $orderNumber, 
                'manage_orders.php');
        }
        
        header('location: ../views/my_orders.php?success=placed&order_num=' . $orderNumber);
    } else {
        header('location: ../views/checkout.php?error=failed');
    }
    exit;
}
?>
