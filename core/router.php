<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require __DIR__ . '/../views/home.php';
        break;

    case 'login':
        require __DIR__ . '/../views/login.php';
        break;

    case 'dashboard':
        require __DIR__ . '/../views/dashboard.php';
        break;

    case 'loginCheck':
        require __DIR__ . '/../controllers/AuthController.php';
        loginCheck();
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        break;

    default:
        echo "404 Page Not Found";
}
