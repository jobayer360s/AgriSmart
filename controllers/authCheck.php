<?php
session_start();


if(!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    
    header('location: login.php');
    exit;
}
?>
