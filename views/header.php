<!-- Header Layout -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart - Smart Farming Platform</title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/responsive.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-brand">🌾 AgriSmart</a>
            
            <ul class="nav-links">
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=marketplace">Marketplace</a></li>
                <li><a href="index.php?page=help">Help & FAQ</a></li>
                
                <?php if ($auth->isLoggedIn()): ?>
                    <li><a href="index.php?page=dashboard">Dashboard</a></li>
                    <li class="user-menu">
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['user']['username']); ?></span>
                        <form action="api/auth/logout.php" method="POST" style="display: inline;">
                            <button type="submit" class="nav-btn">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="index.php?page=auth" class="nav-btn">Sign In</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>
