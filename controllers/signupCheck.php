<?php
session_start();
require_once(__DIR__ . '/../models/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Plain text password
    $role = isset($_POST['role']) ? $_POST['role'] : 'farmer';
    
    // Check if username already exists
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    
    if($stmt->fetch()) {
        header('location: ../views/signup.php?error=username_exists');
        exit;
    }
    
    // Check if email already exists
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if($stmt->fetch()) {
        header('location: ../views/signup.php?error=email_exists');
        exit;
    }
    
    // Insert new user
    $stmt = $GLOBALS['conn']->prepare("INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, ?, 'active')");
    
    if($stmt->execute([$username, $email, $password, $role])) {
        header('location: ../views/login.php?success=registered');
    } else {
        header('location: ../views/signup.php?error=failed');
    }
    exit;
}

// If not POST request, redirect to signup
header('location: ../views/signup.php');
exit;
?>
