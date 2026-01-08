<?php
session_start();
require_once(__DIR__ . '/../models/weatherModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $location = trim($_POST['location']);
    $date = $_POST['forecast_date'];
    $temp = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $rainfall = $_POST['rainfall'];
    $description = trim($_POST['description']);
    
    if(updateWeather($id, $location, $date, $temp, $humidity, $rainfall, $description)) {
        header('location: ../views/manage_weather.php?success=updated');
    } else {
        header('location: ../views/edit_weather.php?id=' . $id . '&error=failed');
    }
    exit;
}
?>
