<?php
session_start();
require_once(__DIR__ . '/../models/weatherModel.php');

if(isset($_GET['id'])) {
    if(deleteWeather($_GET['id'])) {
        header('location: ../views/manage_weather.php?success=deleted');
    } else {
        header('location: ../views/manage_weather.php?error=failed');
    }
    exit;
}
?>
