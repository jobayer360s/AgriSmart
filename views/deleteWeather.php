<?php
session_start();
require_once(__DIR__ . '/../models/weatherModel.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if(deleteWeatherForecast($id)) {
        header('location: ../views/manage_weather.php?success=deleted');
    } else {
        header('location: ../views/manage_weather.php?error=failed');
    }
    exit;
}
?>
