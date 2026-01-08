<?php
session_start();
require_once(__DIR__ . '/../models/shopProductModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier = trim($_POST['supplier']);
    
    if(updateShopProduct($id, $name, $category, $description, $price, $stock, $supplier)) {
        header('location: ../views/manage_products.php?success=updated');
    } else {
        header('location: ../views/edit_product.php?id=' . $id . '&error=failed');
    }
    exit;
}
?>
