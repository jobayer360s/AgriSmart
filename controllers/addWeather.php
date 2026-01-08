<?php
session_start();
require_once(__DIR__ . '/../models/weatherModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $location = trim($_POST['location']);
    $date = $_POST['forecast_date'];
    $temp = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $rainfall = $_POST['rainfall'];
    $description = trim($_POST['description']);
    
    if(addWeather($location, $date, $temp, $humidity, $rainfall, $description)) {
        header('location: ../views/manage_weather.php?success=added');
    } else {
        header('location: ../views/manage_weather.php?error=failed');
    }
    exit;
}
?>
