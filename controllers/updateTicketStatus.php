<?php
session_start();
require_once(__DIR__ . '/../models/supportModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticketId = $_POST['ticket_id'];
    $status = $_POST['status'];
    
    if(updateTicketStatus($ticketId, $status)) {
        echo 'success';
    } else {
        echo 'failed';
    }
}
?>
