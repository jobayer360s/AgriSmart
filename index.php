<?php
// index.php - Landing Page (Root)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart - Smart Farming for Modern Farmers</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <!-- Header -->
    <?php include 'assets/layouts/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>🌾 Welcome to AgriSmart</h1>
            <p>Smart Farming for Modern Bangladeshi Farmers</p>
            <a href="views/auth.php#signup" class="cta-button">Get Started Today</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">✨ Our Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">💧</div>
                <h3>Smart Irrigation</h3>
                <p>Get water timing and quantity recommendations based on weather and crop type.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔍</div>
                <h3>Disease Detection</h3>
                <p>Upload crop images to get expert diagnosis and treatment recommendations.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Market Prices</h3>
                <p>Check live market prices and sell your produce directly to buyers.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💬</div>
                <h3>Expert Chat</h3>
                <p>Get personalized advice from agricultural experts anytime.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🛒</div>
                <h3>Input Marketplace</h3>
                <p>Purchase quality seeds, fertilizers, and farming tools easily.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3>Farm Calendar</h3>
                <p>Organize farm tasks with smart reminders and planning.</p>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="stats">
        <h2>Why Choose AgriSmart?</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>10,000+</h3>
                <p>Active Farmers</p>
            </div>
            <div class="stat-card">
                <h3>500+</h3>
                <p>Expert Tips</p>
            </div>
            <div class="stat-card">
                <h3>₹50L+</h3>
                <p>Products Sold</p>
            </div>
            <div class="stat-card">
                <h3>24/7</h3>
                <p>Support</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <h2>Ready to Transform Your Farming?</h2>
        <p>Join thousands of farmers using AI to boost their productivity and profits</p>
        <div class="cta-buttons">
            <a href="views/auth.php#signup" class="btn-primary">Sign Up Now</a>
            <a href="views/about.php" class="btn-secondary">Learn More</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'assets/layouts/footer.php'; ?>
</body>
</html>