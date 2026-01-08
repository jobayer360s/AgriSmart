<?php
require_once(__DIR__ . '/db.php');

function getTasksByFarmer($farmerId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE farmer_id = ? ORDER BY task_date ASC");
    $stmt->execute([$farmerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addTask($farmerId, $title, $description, $date, $type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO tasks (farmer_id, title, description, task_date, task_type) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$farmerId, $title, $description, $date, $type]);
}

function updateTask($id, $title, $description, $date, $type) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, task_date = ?, task_type = ? WHERE id = ?");
    return $stmt->execute([$title, $description, $date, $type, $id]);
}

function markTaskComplete($id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tasks SET completed = 1 WHERE id = ?");
    return $stmt->execute([$id]);
}

function deleteTask($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    return $stmt->execute([$id]);
}

function getUpcomingTasks($farmerId, $days = 7) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE farmer_id = ? AND task_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY) AND completed = 0 ORDER BY task_date");
    $stmt->execute([$farmerId, $days]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
