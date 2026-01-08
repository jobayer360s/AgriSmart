<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/weatherModel.php');
$weatherData = getAllWeatherData();

$pageTitle = "Manage Weather Forecast";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'added') echo 'Weather forecast added successfully!';
            elseif($_GET['success'] == 'updated') echo 'Weather forecast updated successfully!';
            elseif($_GET['success'] == 'deleted') echo 'Weather forecast deleted successfully!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <div class="box-header">
        <h2>Weather Forecast Management</h2>
        <button onclick="toggleForm('addWeatherForm')" class="btn">Add New Forecast</button>
    </div>
</div>

<div id="addWeatherForm" style="display:none;" class="content-box">
    <h2>Add Weather Forecast</h2>
    <form method="post" action="../controllers/addWeather.php" class="form-style">
        <div class="form-row">
            <div class="form-group">
                <label>Location *</label>
                <input type="text" name="location" value="Dhaka" required>
            </div>
            <div class="form-group">
                <label>Forecast Date *</label>
                <input type="date" name="forecast_date" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Temperature (°C) *</label>
                <input type="number" step="0.1" name="temperature" required>
            </div>
            <div class="form-group">
                <label>Humidity (%) *</label>
                <input type="number" name="humidity" min="0" max="100" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Rainfall (mm) *</label>
                <input type="number" step="0.1" name="rainfall" required>
            </div>
            <div class="form-group">
                <label>Description *</label>
                <input type="text" name="description" placeholder="e.g., Partly cloudy" required>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Add Forecast</button>
            <button type="button" onclick="toggleForm('addWeatherForm')" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<div class="content-box">
    <h2>All Weather Forecasts (<?php echo count($weatherData); ?>)</h2>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Temperature</th>
                    <th>Humidity</th>
                    <th>Rainfall</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($weatherData as $weather): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($weather['location']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($weather['forecast_date'])); ?></td>
                        <td><?php echo $weather['temperature']; ?>°C</td>
                        <td><?php echo $weather['humidity']; ?>%</td>
                        <td><?php echo $weather['rainfall']; ?> mm</td>
                        <td><?php echo htmlspecialchars($weather['description']); ?></td>
                        <td>
                            <a href="edit_weather.php?id=<?php echo $weather['id']; ?>" class="btn-small">Edit</a>
                            <a href="../controllers/deleteWeather.php?id=<?php echo $weather['id']; ?>" 
                               class="btn-small btn-danger" 
                               onclick="return confirm('Delete this forecast?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
