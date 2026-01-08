<?php
session_start();
require_once(__DIR__ . '/../models/marketModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $cropName = trim($_POST['crop_name']);
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $region = trim($_POST['region']);
    $source = trim($_POST['source']);
    
    if(updateMarketPrice($id, $cropName, $price, $unit, $region, $source)) {
        header('location: ../views/manage_market_prices.php?success=updated');
    } else {
        header('location: ../views/manage_market_prices.php?error=failed');
    }
    exit;
}
?>
