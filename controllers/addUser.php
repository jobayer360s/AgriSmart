<?php
session_start();
require_once(__DIR__ . '/../models/db.php');
require_once(__DIR__ . '/../models/userModel.php');

// Check if user is logged in and has permission
if(!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management')) {
    header('location: ../views/login.php');
    exit;
}

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string(getConnection(), $_POST['username']);
    $email = mysqli_real_escape_string(getConnection(), $_POST['email']);
    $password = mysqli_real_escape_string(getConnection(), $_POST['password']);
    $role = mysqli_real_escape_string(getConnection(), $_POST['role']);
    $fullName = isset($_POST['full_name']) ? mysqli_real_escape_string(getConnection(), $_POST['full_name']) : '';
    
    // ============================================
    // PERMISSION CHECK FOR MANAGEMENT USERS
    // ============================================
    if($_SESSION['role'] == 'management') {
        // Management can ONLY create Farmer and Expert users
        if($role != 'farmer' && $role != 'expert') {
            header('location: ../views/manage_users.php?error=permission_denied');
            exit;
        }
    }
    
    // Admin can create any role (no restrictions)
    
    // Check if username or email already exists
    $conn = getConnection();
    $checkSql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ss", $username, $email);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);
    
    if(mysqli_num_rows($checkResult) > 0) {
        mysqli_close($conn);
        header('location: ../views/manage_users.php?error=exists');
        exit;
    }
    
    // Add user
    if(addUser($username, $email, $password, $fullName, $role)) {
        header('location: ../views/manage_users.php?success=added');
    } else {
        header('location: ../views/manage_users.php?error=failed');
    }
} else {
    header('location: ../views/manage_users.php');
}
?>
