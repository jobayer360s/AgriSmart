<?php
// assets/layouts/header.php - Shared Header Component
$current_page = basename($_SERVER['PHP_SELF']);
$is_root = dirname($_SERVER['PHP_SELF']) === '\\' || dirname($_SERVER['PHP_SELF']) === '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? '../../index.php' : 'index.php'; ?>">
                    <span class="logo-icon">🌾</span>
                    <span class="logo-text">AgriSmart</span>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="nav-menu">
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'home.php' : 'views/home.php'; ?>" 
                   class="nav-link <?php echo (strpos($current_page, '.php') === false || $current_page === 'home.php') ? 'active' : ''; ?>">
                    Home
                </a>
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'about.php' : 'views/about.php'; ?>" 
                   class="nav-link <?php echo $current_page === 'about.php' ? 'active' : ''; ?>">
                    About
                </a>
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'tips.php' : 'views/tips.php'; ?>" 
                   class="nav-link <?php echo $current_page === 'tips.php' ? 'active' : ''; ?>">
                    Tips
                </a>
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'marketplace.php' : 'views/marketplace.php'; ?>" 
                   class="nav-link <?php echo $current_page === 'marketplace.php' ? 'active' : ''; ?>">
                    Marketplace
                </a>

            </nav>

            <!-- Auth Buttons -->
            <div class="auth-buttons">
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'auth.php' : 'views/auth.php'; ?>" 
                   class="btn-sign-in">Sign In</a>
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'auth.php#signup' : 'views/auth.php#signup'; ?>" 
                   class="btn-sign-up">Sign Up</a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu hidden">
            <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? '../../index.php' : 'index.php'; ?>" class="mobile-nav-link">Home</a>
            <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'about.php' : 'views/about.php'; ?>" class="mobile-nav-link">About</a>
            <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'tips.php' : 'views/tips.php'; ?>" class="mobile-nav-link">Tips</a>
            <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'marketplace.php' : 'views/marketplace.php'; ?>" class="mobile-nav-link">Marketplace</a>
            <div class="mobile-auth">
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'auth.php' : 'views/auth.php'; ?>" class="mobile-btn-sign-in">Sign In</a>
                <a href="<?php echo (strpos($current_page, '.php') !== false && $current_page !== 'index.php') ? 'auth.php#signup' : 'views/auth.php#signup'; ?>" class="mobile-btn-sign-up">Sign Up</a>
            </div>
        </div>
    </header>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>