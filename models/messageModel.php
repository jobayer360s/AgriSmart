<?php
require_once(__DIR__ . '/db.php');

function getConversations($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT DISTINCT 
                           CASE 
                               WHEN sender_id = ? THEN receiver_id 
                               ELSE sender_id 
                           END as contact_id,
                           u.username, u.role,
                           (SELECT message FROM messages 
                            WHERE (sender_id = ? AND receiver_id = contact_id) 
                               OR (sender_id = contact_id AND receiver_id = ?)
                            ORDER BY created_at DESC LIMIT 1) as last_message,
                           (SELECT created_at FROM messages 
                            WHERE (sender_id = ? AND receiver_id = contact_id) 
                               OR (sender_id = contact_id AND receiver_id = ?)
                            ORDER BY created_at DESC LIMIT 1) as last_time
                           FROM messages m
                           JOIN users u ON u.id = CASE 
                               WHEN m.sender_id = ? THEN m.receiver_id 
                               ELSE m.sender_id 
                           END
                           WHERE sender_id = ? OR receiver_id = ?
                           ORDER BY last_time DESC");
    $stmt->execute([$userId, $userId, $userId, $userId, $userId, $userId, $userId, $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMessages($user1, $user2) {
    global $conn;
    $stmt = $conn->prepare("SELECT m.*, u.username as sender_name 
                           FROM messages m 
                           JOIN users u ON m.sender_id = u.id
                           WHERE (sender_id = ? AND receiver_id = ?) 
                              OR (sender_id = ? AND receiver_id = ?)
                           ORDER BY created_at ASC");
    $stmt->execute([$user1, $user2, $user2, $user1]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function sendMessage($senderId, $receiverId, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    return $stmt->execute([$senderId, $receiverId, $message]);
}

function markMessagesAsRead($userId, $senderId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE messages SET is_read = 1 WHERE receiver_id = ? AND sender_id = ?");
    return $stmt->execute([$userId, $senderId]);
}
?>
