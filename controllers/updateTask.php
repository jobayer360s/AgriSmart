<?php
session_start();
require_once(__DIR__ . '/../models/taskModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date = $_POST['task_date'];
    $type = $_POST['task_type'];
    
    if(updateTask($id, $title, $description, $date, $type)) {
        header('location: ../views/calendar.php?success=updated');
    } else {
        header('location: ../views/calendar.php?error=failed');
    }
    exit;
}
?>
