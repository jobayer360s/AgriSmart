<?php
session_start();
require_once(__DIR__ . '/../models/taskModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date = $_POST['task_date'];
    $type = $_POST['task_type'];
    
    if(addTask($_SESSION['user_id'], $title, $description, $date, $type)) {
        // Create notification for the task
        createNotification($_SESSION['user_id'], 'task', 'New Task Added', 
            'Task "' . $title . '" scheduled for ' . date('M d, Y', strtotime($date)), 
            'calendar.php');
        
        header('location: ../views/calendar.php?success=added');
    } else {
        header('location: ../views/calendar.php?error=failed');
    }
    exit;
}
?>
