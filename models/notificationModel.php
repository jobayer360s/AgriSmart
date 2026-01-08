<?php
require_once(__DIR__ . '/db.php');


function getNotifications($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getUnreadNotificationCount($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM notifications WHERE user_id = ? AND is_read = 0");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}


function markNotificationRead($notificationId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
    return $stmt->execute([$notificationId]);
}

function markAllAsRead($userId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?");
    return $stmt->execute([$userId]);
}


function createNotification($userId, $type, $title, $message, $link = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifications (user_id, type, title, message, link, is_read) VALUES (?, ?, ?, ?, ?, 0)");
    return $stmt->execute([$userId, $type, $title, $message, $link]);
}


function deleteNotification($notificationId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    return $stmt->execute([$notificationId]);
}


function getNotificationById($notificationId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE id = ?");
    $stmt->execute([$notificationId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
