<?php
require_once(__DIR__ . '/db.php');

function getAllSupportTickets() {
    global $conn;
    $stmt = $conn->query("SELECT st.*, u.username, u.role FROM support_tickets st JOIN users u ON st.user_id = u.id ORDER BY st.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTicketById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT st.*, u.username, u.email, u.role FROM support_tickets st JOIN users u ON st.user_id = u.id WHERE st.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTicketsByUser($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM support_tickets WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createTicket($userId, $subject, $message, $category, $priority) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO support_tickets (user_id, subject, message, category, priority) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$userId, $subject, $message, $category, $priority]);
}

// Add this function if missing
function updateTicketStatus($ticketId, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE support_tickets SET status = ? WHERE id = ?");
    return $stmt->execute([$status, $ticketId]);
}

?>
