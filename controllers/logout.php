<?php
session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

session_destroy();

header('location: ../views/login.php?success=logged_out');
exit;
?>
