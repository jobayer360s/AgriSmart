<?php
session_start();
require_once(__DIR__ . '/../models/notificationModel.php');

if(markAllAsRead($_SESSION['user_id'])) {
    header('location: ../views/notifications.php');
} else {
    header('location: ../views/notifications.php?error=failed');
}
exit;
?>
