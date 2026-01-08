<?php
session_start();

// If user is logged in, redirect to their dashboard
if(isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    switch($_SESSION['role']) {
        case 'admin':
            header('location: views/admin_dashboard.php');
            break;
        case 'management':
            header('location: views/management_dashboard.php');
            break;
        case 'expert':
            header('location: views/expert_dashboard.php');
            break;
        case 'farmer':
            header('location: views/farmer_dashboard.php');
            break;
        default:
            header('location: views/login.php');
    }
} else {
    // If not logged in, redirect to login page
    header('location: views/login.php');
}
exit;
?>
