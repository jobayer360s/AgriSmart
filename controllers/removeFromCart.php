<?php
session_start();
require_once(__DIR__ . '/../models/cartModel.php');

if(isset($_GET['id'])) {
    if(removeFromCart($_GET['id'])) {
        header('location: ../views/cart.php?success=removed');
    } else {
        header('location: ../views/cart.php?error=failed');
    }
    exit;
}
?>
