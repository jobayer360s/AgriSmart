<?php
require_once(__DIR__ . '/db.php');

function getTotalRevenue() {
    global $conn;
    $stmt = $conn->query("SELECT SUM(revenue) as total FROM revenue");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
}

function getTotalCost() {
    global $conn;
    $stmt = $conn->query("SELECT SUM(cost) as total FROM revenue");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
}

function getTotalProfit() {
    global $conn;
    $stmt = $conn->query("SELECT SUM(profit) as total FROM revenue");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
}

function addRevenue($orderId, $revenue, $cost, $profit) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO revenue (order_id, revenue, cost, profit) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$orderId, $revenue, $cost, $profit]);
}

function getAllRevenue() {
    global $conn;
    $stmt = $conn->query("SELECT r.*, o.order_number FROM revenue r JOIN orders o ON r.order_id = o.id ORDER BY r.recorded_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
