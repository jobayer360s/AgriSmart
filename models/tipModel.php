<?php
require_once __DIR__ . '/db.php';

function getAllTips() {
    global $conn;
    $stmt = $conn->query("
        SELECT t.*, u.username as expert_name 
        FROM tips t 
        JOIN users u ON t.expert_id = u.id 
        ORDER BY t.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTipById($id) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT t.*, u.username as expert_name 
        FROM tips t 
        JOIN users u ON t.expert_id = u.id 
        WHERE t.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTipsByExpert($expertId) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT t.*, u.username as expert_name 
        FROM tips t 
        JOIN users u ON t.expert_id = u.id 
        WHERE t.expert_id = ? 
        ORDER BY t.created_at DESC
    ");
    $stmt->execute([$expertId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addTip($expertId, $title, $content, $category) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO tips (expert_id, title, content, category, created_at) VALUES (?, ?, ?, ?, NOW())");
    return $stmt->execute([$expertId, $title, $content, $category]);
}

function updateTip($id, $title, $content, $category) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tips SET title = ?, content = ?, category = ? WHERE id = ?");
    return $stmt->execute([$title, $content, $category, $id]);
}

function deleteTip($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM tips WHERE id = ?");
    return $stmt->execute([$id]);
}


function searchTips($query) {
    global $conn;
    $searchTerm = "%$query%";
    
    $stmt = $conn->prepare("
        SELECT t.*, u.username as expert_name
        FROM tips t
        JOIN users u ON t.expert_id = u.id
        WHERE t.title LIKE ? OR t.content LIKE ? OR t.category LIKE ?
        ORDER BY t.title ASC
        LIMIT 20
    ");
    
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    
    return $stmt->get_result()->fetchAll(PDO::FETCH_ASSOC);
}


?>
