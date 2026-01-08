<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'farmer') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

require_once __DIR__ . '/../models/cartModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = $_POST['cartid'] ?? 0;
    $quantity = $_POST['quantity'] ?? 1;
    
    if (empty($cartId) || $quantity < 1) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        exit();
    }
    
    try {
        if (updateCartQuantity($cartId, $quantity)) {
            $cartTotal = getCartTotal($_SESSION['userid']);
            echo json_encode([
                'success' => true,
                'message' => 'Quantity updated',
                'cart_total' => $cartTotal
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
