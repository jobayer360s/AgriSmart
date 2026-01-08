<?php
session_start();
require_once(__DIR__ . '/../models/supportModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['ticket_id'];
    $status = $_POST['status'];
    $response = trim($_POST['response']);
    
    if(updateTicketStatus($id, $status, $response)) {
        // Notify user
        $ticket = getTicketById($id);
        createNotification($ticket['user_id'], 'ticket', 'Support Ticket Updated', 
            'Your ticket "' . $ticket['subject'] . '" has been updated', 
            'support_tickets.php');
        
        header('location: ../views/support_tickets.php?success=updated');
    } else {
        header('location: ../views/support_tickets.php?error=failed');
    }
    exit;
}
?>
