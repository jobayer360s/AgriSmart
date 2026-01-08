<?php
session_start();
require_once(__DIR__ . '/../models/tipModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];
    
    if(updateTip($id, $title, $content, $category)) {
        header('location: ../views/my_tips.php?success=updated');
    } else {
        header('location: ../views/edit_tip.php?id=' . $id . '&error=failed');
    }
    exit;
}
?>
