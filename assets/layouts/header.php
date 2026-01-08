<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - AgriSmart' : 'AgriSmart'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="top-nav">
        <div class="nav-container">
            <a href="<?php 
                if(isset($_SESSION['role'])) {
                    switch($_SESSION['role']) {
                        case 'admin': echo 'admin_dashboard.php'; break;
                        case 'management': echo 'management_dashboard.php'; break;
                        case 'expert': echo 'expert_dashboard.php'; break;
                        case 'farmer': echo 'farmer_dashboard.php'; break;
                        default: echo 'login.php';
                    }
                } else {
                    echo 'login.php';
                }
            ?>" class="nav-logo">🌾 AgriSmart</a>
            
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
            
            <ul class="nav-menu" id="navMenu">
                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin')): ?>
                    
                    <li><a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin_dashboard.php' : 'management_dashboard.php'; ?>">Dashboard</a></li>
                    <li><a href="manage_users.php">Users</a></li>
                    <li><a href="manage_products.php">Products</a></li>
                    <li><a href="manage_orders.php">Orders</a></li>
                    <li><a href="manage_tips.php">Tips</a></li>
                    <li><a href="manage_weather.php">Weather</a></li>
                    <li><a href="revenue_report.php">Revenue</a></li>
                
                <?php elseif(isset($_SESSION['role']) && ($_SESSION['role'] == 'management')): ?>
                   
                    <li><a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin_dashboard.php' : 'management_dashboard.php'; ?>">Dashboard</a></li>
                    <li><a href="manage_users.php">Users</a></li>
                    <li><a href="manage_products.php">Products</a></li>
                    <li><a href="manage_orders.php">Orders</a></li>
                    <li><a href="manage_tips.php">Tips</a></li>
                    <li><a href="manage_weather.php">Weather</a></li>
                    
                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'farmer'): ?>
                    
                    <li><a href="farmer_dashboard.php">Dashboard</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="my_orders.php">Orders</a></li>
                    <li><a href="calendar.php">Calendar</a></li>
                    <li><a href="all_tips.php">Tips</a></li>
                    <li><a href="questions.php">Q&A</a></li>
                    <li><a href="chat_list.php">Chat</a></li>
                    <li><a href="weather.php">Weather</a></li>
                    
                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'expert'): ?>
                   
                    <li><a href="expert_dashboard.php">Dashboard</a></li>
                    <li><a href="my_tips.php">My Tips</a></li>
                    <li><a href="post_tip.php">Post Tip</a></li>
                    <li><a href="questions.php">Q&A</a></li>
                    <li><a href="chat_list.php">Chat</a></li>
                    <li><a href="all_tips.php">All Tips</a></li>
                    <li><a href="weather.php">Weather</a></li>
                <?php endif; ?>
            </ul>
            
            <div class="nav-user">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php
                    $unreadCount = 0;
                    if(file_exists(__DIR__ . '/../../models/notificationModel.php')) {
                        require_once(__DIR__ . '/../../models/notificationModel.php');
                        try {
                            $unreadCount = getUnreadNotificationCount($_SESSION['user_id']);
                        } catch(Exception $e) {
                            $unreadCount = 0;
                        }
                    }
                    ?>
                    <a href="notifications.php" class="notification-icon">
                        🔔
                        <?php if($unreadCount > 0): ?>
                            <span class="notification-badge"><?php echo $unreadCount; ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="user-info">
                        <a href="profile.php" style="text-decoration: none; color: white;">
                            <div class="user-avatar">
                                <?php echo isset($_SESSION['username']) ? strtoupper(substr($_SESSION['username'], 0, 1)) : 'U'; ?>
                            </div>
                        </a>
                        <div>
                            <div style="font-weight: 600;"><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User'; ?></div>
                            <div class="user-role"><?php echo isset($_SESSION['role']) ? ucfirst(htmlspecialchars($_SESSION['role'])) : 'Guest'; ?></div>
                        </div>
                    </div>
                    <a href="../controllers/logout.php" class="btn btn-secondary" style="margin-left: 15px;">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn" style="margin-left: 15px;">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <div class="main-container">
        <?php
        if(isset($_GET['success'])) {
            echo '<div class="alert alert-success">';
            switch($_GET['success']) {
                case 'added': echo '✅ Successfully added!'; break;
                case 'updated': echo '✅ Successfully updated!'; break;
                case 'deleted': echo '✅ Successfully deleted!'; break;
                case 'completed': echo '✅ Successfully completed!'; break;
                default: echo '✅ Operation successful!';
            }
            echo '</div>';
        }
        if(isset($_GET['error'])) {
            echo '<div class="alert alert-error">';
            switch($_GET['error']) {
                case 'failed': echo '❌ Operation failed!'; break;
                case 'not_found': echo '❌ Item not found!'; break;
                case 'permission_denied': echo '❌ Permission denied!'; break;
                default: echo '❌ An error occurred!';
            }
            echo '</div>';
        }
        ?>
        <script>
        function toggleMobileMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }
        window.onload = function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        }
        </script>

    </div>
    
</body>
</html>
