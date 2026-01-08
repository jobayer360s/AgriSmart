<?php
require_once(__DIR__ . '/db.php');

function getCartItems($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT c.*, sp.name, sp.price, sp.stock, sp.category 
                           FROM cart c 
                           JOIN shop_products sp ON c.product_id = sp.id 
                           WHERE c.user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addToCart($userId, $productId, $quantity = 1) {
    global $conn;
    // Check if already in cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($existing) {
        // Update quantity
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        return $stmt->execute([$quantity, $userId, $productId]);
    } else {
        // Add new
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $productId, $quantity]);
    }
}

function updateCartQuantity($cartId, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    return $stmt->execute([$quantity, $cartId]);
}

function removeFromCart($cartId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    return $stmt->execute([$cartId]);
}

function clearCart($userId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    return $stmt->execute([$userId]);
}

function getCartTotal($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(c.quantity * sp.price) as total 
                           FROM cart c 
                           JOIN shop_products sp ON c.product_id = sp.id 
                           WHERE c.user_id = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
}
?>
