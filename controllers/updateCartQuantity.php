<?php
session_start();
require_once(__DIR__ . '/../models/cartModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $cartId = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    
    if(updateCartQuantity($cartId, $quantity)) {
        header('location: ../views/cart.php?success=updated');
    } else {
        header('location: ../views/cart.php?error=failed');
    }
    exit;
}
?>
