<?php
require_once(__DIR__ . '/db.php');

function getAllOrders() {
    global $conn;
    $stmt = $conn->query("SELECT o.*, u.username as farmer_name FROM orders o JOIN users u ON o.farmer_id = u.id ORDER BY o.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT o.*, u.username as farmer_name, u.email as farmer_email FROM orders o JOIN users u ON o.farmer_id = u.id WHERE o.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getOrdersByFarmer($farmerId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM orders WHERE farmer_id = ? ORDER BY created_at DESC");
    $stmt->execute([$farmerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderItems($orderId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->execute([$orderId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateOrderStatus($orderId, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE orders SET status = ?, updated_at = NOW() WHERE id = ?");
    return $stmt->execute([$status, $orderId]);
}

function createOrder($orderNumber, $farmerId, $totalAmount, $address) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO orders (order_number, farmer_id, total_amount, delivery_address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$orderNumber, $farmerId, $totalAmount, $address]);
    return $conn->lastInsertId();
}

function addOrderItem($orderId, $productId, $productName, $quantity, $price) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$orderId, $productId, $productName, $quantity, $price]);
}
?>
