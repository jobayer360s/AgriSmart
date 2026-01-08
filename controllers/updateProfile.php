<?php
session_start();
require_once(__DIR__ . '/../models/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    
    $stmt = $GLOBALS['conn']->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    if($stmt->execute([$username, $email, $_SESSION['user_id']])) {
        $_SESSION['username'] = $username;
        header('location: ../views/edit_profile.php?success=updated');
    } else {
        header('location: ../views/edit_profile.php?error=failed');
    }
    exit;
}
?>
