<?php
require_once __DIR__ . '/db.php';

function getAllTips() {
    global $conn;
     setcookie('last_tips_view', date('Y-m-d H:i:s'), time() + (86400 * 30), "/");
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
    setcookie('last_viewed_tip', $id, time() + (86400 * 7), "/");
    setcookie('last_tip_view_time', date('Y-m-d H:i:s'), time() + (86400 * 7), "/");
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
    setcookie('last_expert_tips_view', $expertId, time() + (86400 * 7), "/");
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
     if($result) {
        setcookie('last_tip_added', date('Y-m-d H:i:s'), time() + (86400 * 30), "/");
        setcookie('last_tip_category', $category, time() + (86400 * 30), "/");
    }
}

function updateTip($id, $title, $content, $category) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tips SET title = ?, content = ?, category = ? WHERE id = ?");
    return $stmt->execute([$title, $content, $category, $id]);
    if($result) {
        setcookie('last_tip_updated', $id, time() + (86400 * 30), "/");
        setcookie('last_tip_update_time', date('Y-m-d H:i:s'), time() + (86400 * 30), "/");
    }
}

function deleteTip($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM tips WHERE id = ?");
    return $stmt->execute([$id]);
    if($result) {
        setcookie('last_tip_deleted', $id, time() + (86400 * 7), "/");
        setcookie('last_tip_delete_time', date('Y-m-d H:i:s'), time() + (86400 * 7), "/");
    }
}
?>
