<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    // Not logged in - redirect to login page
    header('location: login.php');
    exit;
}
?>
