<?php
require_once __DIR__ . '/db.php';

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

function addShopProduct($name, $description, $price, $stock, $category, $image = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO shop_products (name, description, price, stock, category, image, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    return $stmt->execute([$name, $description, $price, $stock, $category, $image]);
}

function updateShopProduct($id, $name, $description, $price, $stock, $category, $image = null) {
    global $conn;
    if ($image) {
        $stmt = $conn->prepare("UPDATE shop_products SET name = ?, description = ?, price = ?, stock = ?, category = ?, image = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $price, $stock, $category, $image, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE shop_products SET name = ?, description = ?, price = ?, stock = ?, category = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $price, $stock, $category, $id]);
    }
}

function deleteShopProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM shop_products WHERE id = ?");
    return $stmt->execute([$id]);
}

// NEW: Search function
function searchShopProducts($query) {
    global $conn;
    $searchTerm = "%$query%";
    $stmt = $conn->prepare("
        SELECT * FROM shop_products 
        WHERE name LIKE ? OR description LIKE ? OR category LIKE ? 
        ORDER BY name ASC 
        LIMIT 20
    ");
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
