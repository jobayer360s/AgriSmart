<?php
session_start();
require_once(__DIR__ . '/../models/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password']; // Plain text password
    
    // Check credentials
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user) {
        // Check if user is active
        if($user['status'] != 'active') {
            header('location: ../views/login.php?error=suspended');
            exit;
        }
        
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        
        // Redirect based on role
        switch($user['role']) {
            case 'admin':
                header('location: ../views/admin_dashboard.php');
                break;
            case 'management':
                header('location: ../views/management_dashboard.php');
                break;
            case 'expert':
                header('location: ../views/expert_dashboard.php');
                break;
            case 'farmer':
                header('location: ../views/farmer_dashboard.php');
                break;
            default:
                header('location: ../views/login.php?error=invalid_role');
        }
    } else {
        header('location: ../views/login.php?error=invalid');
    }
    exit;
}

// If not POST request, redirect to login
header('location: ../views/login.php');
exit;
?>
