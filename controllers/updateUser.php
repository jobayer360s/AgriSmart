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
    $id = intval($_POST['id']);
    $username = mysqli_real_escape_string(getConnection(), $_POST['username']);
    $email = mysqli_real_escape_string(getConnection(), $_POST['email']);
    $fullName = mysqli_real_escape_string(getConnection(), $_POST['full_name']);
    $phone = mysqli_real_escape_string(getConnection(), $_POST['phone']);
    $address = mysqli_real_escape_string(getConnection(), $_POST['address']);
    $role = mysqli_real_escape_string(getConnection(), $_POST['role']);
    $status = mysqli_real_escape_string(getConnection(), $_POST['status']);
    $password = isset($_POST['password']) && !empty($_POST['password']) ? mysqli_real_escape_string(getConnection(), $_POST['password']) : null;
    
    // ============================================
    // PERMISSION CHECK: Get the user being edited
    // ============================================
    $userToEdit = getUserById($id);
    
    if(!$userToEdit) {
        header('location: ../views/manage_users.php?error=not_found');
        exit;
    }
    
    // Management cannot edit Admin users
    if($_SESSION['role'] == 'management' && $userToEdit['role'] == 'admin') {
        header('location: ../views/manage_users.php?error=permission_denied');
        exit;
    }
    
    // Management cannot change user role to Admin
    if($_SESSION['role'] == 'management' && $role == 'admin') {
        header('location: ../views/manage_users.php?error=permission_denied');
        exit;
    }
    
    // Update user
    $conn = getConnection();
    
    if($password) {
        // Update with new password
        $sql = "UPDATE users SET username = ?, email = ?, password = ?, full_name = ?, phone = ?, address = ?, role = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $username, $email, $password, $fullName, $phone, $address, $role, $status, $id);
    } else {
        // Update without changing password
        $sql = "UPDATE users SET username = ?, email = ?, full_name = ?, phone = ?, address = ?, role = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $username, $email, $fullName, $phone, $address, $role, $status, $id);
    }
    
    if(mysqli_stmt_execute($stmt)) {
        mysqli_close($conn);
        header('location: ../views/manage_users.php?success=updated');
    } else {
        mysqli_close($conn);
        header('location: ../views/edit_user.php?id=' . $id . '&error=failed');
    }
} else {
    header('location: ../views/manage_users.php');
}
?>
