<?php
session_start();
require_once(__DIR__ . '/../models/shopProductModel.php');

if(isset($_GET['id'])) {
    if(deleteShopProduct($_GET['id'])) {
        header('location: ../views/manage_products.php?success=deleted');
    } else {
        header('location: ../views/manage_products.php?error=failed');
    }
    exit;
}
?>

