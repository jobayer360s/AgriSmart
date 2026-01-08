<?php
session_start();
require_once(__DIR__ . '/../models/marketModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $crop = trim($_POST['crop_name']);
    $price = $_POST['price'];
    $location = trim($_POST['location']);
    $date = $_POST['date'];
    
    if(addMarketPrice($crop, $price, $location, $date)) {
        header('location: ../views/manage_market_prices.php?success=added');
    } else {
        header('location: ../views/manage_market_prices.php?error=failed');
    }
    exit;
}
?>
