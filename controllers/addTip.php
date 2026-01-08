<?php
session_start();
require_once(__DIR__ . '/../models/tipModel.php');
require_once(__DIR__ . '/../models/notificationModel.php');

if (!isset($_SESSION['userid'])) {
    
    if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_token'])) {
        $_SESSION['userid'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['role'] = $_COOKIE['role'];
    } else {
        header('location: ../views/login.php');
        exit;
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];
    
    if(addTip($_SESSION['user_id'], $title, $content, $category)) {
    
        $stmt = $GLOBALS['conn']->query("SELECT id FROM users WHERE role = 'farmer'");
        while($farmer = $stmt->fetch(PDO::FETCH_ASSOC)) {
            createNotification($farmer['id'], 'tip', 'New Expert Tip', 
                'New tip posted: "' . $title . '"', 'all_tips.php');
        }
        
        header('location: ../views/my_tips.php?success=added');
    } else {
        header('location: ../views/post_tip.php?error=failed');
    }
    exit;
}
?>
