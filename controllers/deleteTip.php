<?php
session_start();
require_once(__DIR__ . '/../models/tipModel.php');

if(isset($_GET['id'])) {
    if(deleteTip($_GET['id'])) {
        header('location: ../views/my_tips.php?success=deleted');
    } else {
        header('location: ../views/my_tips.php?error=failed');
    }
    exit;
}
?>
