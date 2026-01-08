<?php
require_once(__DIR__ . '/db.php');

function getMarketPrices() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM market_prices WHERE price_date = CURDATE() ORDER BY crop_name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMarketPrices() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM market_prices ORDER BY price_date DESC, crop_name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addMarketPrice($cropName, $price, $unit, $region, $source, $date, $createdBy) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO market_prices (crop_name, price, unit, region, source, price_date, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$cropName, $price, $unit, $region, $source, $date, $createdBy]);
}

function updateMarketPrice($id, $cropName, $price, $unit, $region, $source) {
    global $conn;
    $stmt = $conn->prepare("UPDATE market_prices SET crop_name = ?, price = ?, unit = ?, region = ?, source = ? WHERE id = ?");
    return $stmt->execute([$cropName, $price, $unit, $region, $source, $id]);
}

function deleteMarketPrice($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM market_prices WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
