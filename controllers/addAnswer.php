<?php
session_start();
require_once(__DIR__ . '/../models/questionModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $questionId = $_POST['question_id'];
    $content = trim($_POST['content']);
    
    if(empty($content)) {
        header('location: ../views/view_question.php?id=' . $questionId . '&error=empty');
        exit;
    }
    
    if(addAnswer($questionId, $_SESSION['user_id'], $content)) {
        // Notify farmer
        $question = getQuestionById($questionId);
        createNotification($question['farmer_id'], 'answer', 'New Answer to Your Question', 
            'Expert answered your question: "' . $question['title'] . '"', 
            'view_question.php?id=' . $questionId);
        
        header('location: ../views/view_question.php?id=' . $questionId . '&success=answered');
    } else {
        header('location: ../views/view_question.php?id=' . $questionId . '&error=failed');
    }
    exit;
}
?>
