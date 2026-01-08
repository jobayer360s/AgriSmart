<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin','management'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

require_once('../models/userModel.php');

$query = trim($_POST['query'] ?? '');

if ($query === '') {
    echo json_encode(['status' => 'success', 'data' => []]);
    exit;
}

$users = searchUsersByKeyword($query);

echo json_encode(['status' => 'success', 'data' => $users]);
exit;
?>
