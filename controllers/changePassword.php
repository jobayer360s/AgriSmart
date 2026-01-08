<?php
session_start();
require_once(__DIR__ . '/../models/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    

    if($newPassword != $confirmPassword) {
        header('location: ../views/edit_profile.php?error=mismatch');
        exit;
    }
    

    $stmt = $GLOBALS['conn']->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user['password'] != $currentPassword) {
        header('location: ../views/edit_profile.php?error=wrong_password');
        exit;
    }
    

    $stmt = $GLOBALS['conn']->prepare("UPDATE users SET password = ? WHERE id = ?");
    
    if($stmt->execute([$newPassword, $_SESSION['user_id']])) {
        header('location: ../views/edit_profile.php?success=password_changed');
    } else {
        header('location: ../views/edit_profile.php?error=failed');
    }
    exit;
}

header('location: ../views/edit_profile.php');
exit;
?>
