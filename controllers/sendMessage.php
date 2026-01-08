<?php
session_start();
require_once(__DIR__ . '/../models/messageModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receiverId = $_POST['receiver_id'];
    $message = trim($_POST['message']);
    
    if(empty($message)) {
        echo 'empty';
        exit;
    }
    
    if(sendMessage($_SESSION['user_id'], $receiverId, $message)) {
       
        createNotification($receiverId, 'message', 'New Message', 
            'You have a new message from ' . $_SESSION['username'], 
            'chat.php?user=' . $_SESSION['user_id']);
        
        echo 'success';
    } else {
        echo 'failed';
    }
}
?>
