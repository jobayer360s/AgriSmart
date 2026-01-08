<?php
session_start();
require_once(__DIR__ . '/../models/shopProductModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier = trim($_POST['supplier']);
    
    if(addShopProduct($name, $category, $description, $price, $stock, $supplier)) {
        header('location: ../views/manage_products.php?success=added');
    } else {
        header('location: ../views/manage_products.php?error=failed');
    }
    exit;
}
?>
