<?php
session_start();
require_once(__DIR__ . '/../models/questionModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    if(empty($title) || empty($content)) {
        header('location: ../views/ask_question.php?error=empty');
        exit;
    }
    
    if(addQuestion($_SESSION['user_id'], $title, $content)) {
        header('location: ../views/questions.php?success=asked');
    } else {
        header('location: ../views/ask_question.php?error=failed');
    }
    exit;
}
?>
