<?php
session_start();
require_once(__DIR__ . '/../models/cartModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    if(addToCart($_SESSION['user_id'], $productId, $quantity)) {
        header('location: ../views/shop.php?success=added');
    } else {
        header('location: ../views/shop.php?error=failed');
    }
    exit;
}
?>
