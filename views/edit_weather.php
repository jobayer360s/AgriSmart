<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/weatherModel.php');

if(!isset($_GET['id'])){
    header('location: manage_weather.php');
    exit;
}

$weather = getWeatherById($_GET['id']);

if(!$weather){
    header('location: manage_weather.php?error=not_found');
    exit;
}

$pageTitle = "Edit Weather Forecast";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Edit Weather Forecast</h2>
    
    <form method="post" action="../controllers/updateWeather.php" class="form-style">
        <input type="hidden" name="id" value="<?php echo $weather['id']; ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Location *</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($weather['location']); ?>" required>
            </div>
            <div class="form-group">
                <label>Forecast Date *</label>
                <input type="date" name="forecast_date" value="<?php echo $weather['forecast_date']; ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Temperature (°C) *</label>
                <input type="number" step="0.1" name="temperature" value="<?php echo $weather['temperature']; ?>" required>
            </div>
            <div class="form-group">
                <label>Humidity (%) *</label>
                <input type="number" name="humidity" value="<?php echo $weather['humidity']; ?>" min="0" max="100" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Rainfall (mm) *</label>
                <input type="number" step="0.1" name="rainfall" value="<?php echo $weather['rainfall']; ?>" required>
            </div>
            <div class="form-group">
                <label>Description *</label>
                <input type="text" name="description" value="<?php echo htmlspecialchars($weather['description']); ?>" required>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update Forecast</button>
            <a href="manage_weather.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
