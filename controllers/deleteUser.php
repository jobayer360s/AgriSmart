<?php
session_start();
require_once(__DIR__ . '/../models/db.php');
require_once(__DIR__ . '/../models/userModel.php');

// Check if user is logged in and has permission
if(!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management')) {
    header('location: ../views/login.php');
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Cannot delete yourself
if($id == $_SESSION['user_id']) {
    header('location: ../views/manage_users.php?error=cannot_delete_self');
    exit;
}

// ============================================
// PERMISSION CHECK: Get the user being deleted
// ============================================
$userToDelete = getUserById($id);

if(!$userToDelete) {
    header('location: ../views/manage_users.php?error=not_found');
    exit;
}

// Management cannot delete Admin users
if($_SESSION['role'] == 'management' && $userToDelete['role'] == 'admin') {
    header('location: ../views/manage_users.php?error=permission_denied');
    exit;
}

// Delete user
if(deleteUser($id)) {
    header('location: ../views/manage_users.php?success=deleted');
} else {
    header('location: ../views/manage_users.php?error=failed');
}
?>
