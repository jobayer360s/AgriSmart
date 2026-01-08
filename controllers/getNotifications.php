<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

require_once __DIR__ . '/../models/notificationModel.php';

try {
    $notifications = getNotifications($_SESSION['userid']);
    $unreadCount = getUnreadCount($_SESSION['userid']);
    
    echo json_encode([
        'success' => true,
        'notifications' => $notifications,
        'unread_count' => $unreadCount
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch notifications'
    ]);
}
?>
