<?php
require_once('../controllers/authCheck.php');
require_once(__DIR__ . '/../models/weatherModel.php');

$weatherData = getAllWeatherData();

$pageTitle = "Weather Forecast";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Weather Forecast for Bangladesh</h2>
    <p>Plan your farming activities based on weather predictions</p>
</div>

<?php if(count($weatherData) > 0): ?>
    <div class="weather-grid">
        <?php foreach($weatherData as $weather): ?>
            <div class="weather-card">
                <div class="weather-header">
                    <h3><?php echo htmlspecialchars($weather['location']); ?></h3>
                    <span class="badge"><?php echo date('M d, Y', strtotime($weather['forecast_date'])); ?></span>
                </div>
                
                <div class="weather-body">
                    <div class="weather-icon">
                        <?php 
                            $desc = strtolower($weather['description']);
                            if(strpos($desc, 'rain') !== false) echo '🌧️';
                            elseif(strpos($desc, 'cloud') !== false) echo '☁️';
                            elseif(strpos($desc, 'sun') !== false) echo '☀️';
                            else echo '🌤️';
                        ?>
                    </div>
                    <div class="weather-temp"><?php echo $weather['temperature']; ?>°C</div>
                    <div class="weather-desc"><?php echo htmlspecialchars($weather['description']); ?></div>
                </div>
                
                <div class="weather-details">
                    <div class="weather-detail">
                        <span>💧 Humidity</span>
                        <strong><?php echo $weather['humidity']; ?>%</strong>
                    </div>
                    <div class="weather-detail">
                        <span>🌧️ Rainfall</span>
                        <strong><?php echo $weather['rainfall']; ?> mm</strong>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="content-box">
        <p>No weather forecast available at the moment.</p>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
