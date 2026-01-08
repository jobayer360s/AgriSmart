<?php
session_start();
require_once(__DIR__ . '/../models/marketModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $crop = trim($_POST['crop_name']);
    $price = $_POST['price'];
    $location = trim($_POST['location']);
    $date = $_POST['date'];
    
    if(updateMarketPrice($id, $crop, $price, $location, $date)) {
        header('location: ../views/manage_market_prices.php?success=updated');
    } else {
        header('location: ../views/edit_market_price.php?id=' . $id . '&error=failed');
    }
    exit;
}
?>
