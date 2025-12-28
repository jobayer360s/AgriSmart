<?php
// views/home.php - User Dashboard (Post-Login)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart Dashboard - Smart Farming for Modern Farmers</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <!-- Header -->
    <?php include '../assets/layouts/header.php'; ?>

    <!-- Dashboard Welcome Section -->
    <section class="dashboard-welcome">
        <div class="welcome-container">
            <div class="welcome-content">
                <h1>Welcome to AgriSmart! 🌾</h1>
                <p>Manage your farm efficiently with our smart tools</p>
            </div>
            
        </div>
    </section>

    <!-- Quick Access Features -->
    <section class="quick-access">
        <h2>Quick Access Tools</h2>
        <div class="quick-access-grid">
            <a href="#" class="quick-card">
                <div class="card-icon">💧</div>
                <h3>Smart Irrigation</h3>
                <p>Check water schedule</p>
            </a>

            <a href="#" class="quick-card">
                <div class="card-icon">🔍</div>
                <h3>Disease Check</h3>
                <p>Upload crop image</p>
            </a>

            <a href="#" class="quick-card">
                <div class="card-icon">💰</div>
                <h3>Market Prices</h3>
                <p>Live price updates</p>
            </a>

            <a href="#" class="quick-card">
                <div class="card-icon">💬</div>
                <h3>Expert Chat</h3>
                <p>Ask expert advice</p>
            </a>

            <a href="#" class="quick-card">
                <div class="card-icon">🛒</div>
                <h3>Marketplace</h3>
                <p>Buy seeds & tools</p>
            </a>

            <a href="#" class="quick-card">
                <div class="card-icon">📅</div>
                <h3>Farm Calendar</h3>
                <p>Plan your tasks</p>
            </a>
        </div>
    </section>


    <!-- Recommendations Section -->
    <section class="recommendations">
        <h2>Smart Recommendations</h2>
        <div class="recommendation-list">
            <div class="recommendation-card">
                <div class="rec-icon">🌱</div>
                <div class="rec-content">
                    <h4>Best Time to Plant</h4>
                    <p>Based on weather data, now is ideal for planting vegetables in your region</p>
                    <a href="#" class="rec-link">Learn More →</a>
                </div>
            </div>

            <div class="recommendation-card">
                <div class="rec-icon">🐛</div>
                <div class="rec-content">
                    <h4>Pest Alert</h4>
                    <p>Farmers in nearby areas reported rice pests. Take preventive measures</p>
                    <a href="#" class="rec-link">Get Solution →</a>
                </div>
            </div>

            <div class="recommendation-card">
                <div class="rec-icon">💡</div>
                <div class="rec-content">
                    <h4>Fertilizer Tip</h4>
                    <p>Your soil needs nitrogen boost. Check our marketplace for best deals</p>
                    <a href="#" class="rec-link">Shop Now →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../assets/layouts/footer.php'; ?>
</body>
</html>