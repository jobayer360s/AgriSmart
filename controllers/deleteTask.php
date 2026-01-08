<?php
session_start();
require_once(__DIR__ . '/../models/taskModel.php');

if(isset($_GET['id'])) {
    if(deleteTask($_GET['id'])) {
        header('location: ../views/calendar.php?success=deleted');
    } else {
        header('location: ../views/calendar.php?error=failed');
    }
    exit;
}
?>
