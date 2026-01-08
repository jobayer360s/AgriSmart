<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userid']) || !in_array($_SESSION['role'], ['admin', 'management'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

require_once __DIR__ . '/../models/supportModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = $_POST['ticketid'] ?? 0;
    $status = $_POST['status'] ?? '';
    
    if (empty($ticketId) || empty($status)) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        exit();
    }
    
    try {
        if (updateTicketStatus($ticketId, $status)) {
            echo json_encode(['success' => true, 'message' => 'Ticket status updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
