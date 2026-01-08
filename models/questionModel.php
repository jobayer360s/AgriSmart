<?php
require_once(__DIR__ . '/db.php');

function getAllQuestions() {
    global $conn;
    $stmt = $conn->query("SELECT q.*, u.username as farmer_name, 
                         (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answer_count
                         FROM questions q 
                         JOIN users u ON q.farmer_id = u.id 
                         ORDER BY q.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getQuestionById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT q.*, u.username as farmer_name 
                           FROM questions q 
                           JOIN users u ON q.farmer_id = u.id 
                           WHERE q.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAnswers($questionId) {
    global $conn;
    $stmt = $conn->prepare("SELECT a.*, u.username as expert_name 
                           FROM answers a 
                           JOIN users u ON a.expert_id = u.id 
                           WHERE a.question_id = ? 
                           ORDER BY a.created_at ASC");
    $stmt->execute([$questionId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addQuestion($farmerId, $title, $content) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO questions (farmer_id, title, content) VALUES (?, ?, ?)");
    return $stmt->execute([$farmerId, $title, $content]);
}

function addAnswer($questionId, $expertId, $content) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO answers (question_id, expert_id, content) VALUES (?, ?, ?)");
    $result = $stmt->execute([$questionId, $expertId, $content]);
    
    if($result) {
        // Update question status
        $stmt = $conn->prepare("UPDATE questions SET status = 'answered' WHERE id = ?");
        $stmt->execute([$questionId]);
    }
    
    return $result;
}

function deleteQuestion($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
