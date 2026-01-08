<?php
require_once(__DIR__ . '/db.php');

function getAllShopProducts() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM shop_products ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getShopProductById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM shop_products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addShopProduct($name, $description, $category, $price, $stock, $supplier, $createdBy) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO shop_products (name, description, category, price, stock, supplier_name, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $description, $category, $price, $stock, $supplier, $createdBy]);
}

function updateShopProduct($id, $name, $description, $category, $price, $stock, $supplier) {
    global $conn;
    $stmt = $conn->prepare("UPDATE shop_products SET name = ?, description = ?, category = ?, price = ?, stock = ?, supplier_name = ? WHERE id = ?");
    return $stmt->execute([$name, $description, $category, $price, $stock, $supplier, $id]);
}

function deleteShopProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM shop_products WHERE id = ?");
    return $stmt->execute([$id]);
}

function updateStock($productId, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE shop_products SET stock = stock - ? WHERE id = ?");
    return $stmt->execute([$quantity, $productId]);
}
?>
