<?php
session_start();
require_once(__DIR__ . '/../models/marketModel.php');

if(isset($_GET['id'])) {
    if(deleteMarketPrice($_GET['id'])) {
        header('location: ../views/manage_market_prices.php?success=deleted');
    } else {
        header('location: ../views/manage_market_prices.php?error=failed');
    }
    exit;
}
?>
