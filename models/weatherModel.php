<?php
require_once(__DIR__ . '/db.php');

function getAllWeatherData() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM weather_forecast ORDER BY forecast_date DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getWeatherById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM weather_forecast WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addWeather($location, $date, $temp, $humidity, $rainfall, $description) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO weather_forecast (location, forecast_date, temperature, humidity, rainfall, description) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$location, $date, $temp, $humidity, $rainfall, $description]);
}

function updateWeather($id, $location, $date, $temp, $humidity, $rainfall, $description) {
    global $conn;
    $stmt = $conn->prepare("UPDATE weather_forecast SET location = ?, forecast_date = ?, temperature = ?, humidity = ?, rainfall = ?, description = ? WHERE id = ?");
    return $stmt->execute([$location, $date, $temp, $humidity, $rainfall, $description, $id]);
}

function deleteWeather($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM weather_forecast WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
