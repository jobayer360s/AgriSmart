<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

require_once('../models/tipModel.php');

$query = trim($_POST['query'] ?? '');

if ($query === '') {
    echo json_encode(['status' => 'success', 'data' => []]);
    exit;
}

$tips = searchTipsByKeyword($query);

echo json_encode(['status' => 'success', 'data' => $tips]);
exit;
?>
