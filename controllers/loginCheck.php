<?php
session_start();
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../models/userModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;
    
    
    if (empty($username) || empty($password)) {
        header('Location: ../views/login.php?error=invalid');
        exit();
    }
    
    
    try {
        $user = getUserByUsername($username);
        
        if ($user) {
            
            $passwordMatch = false;
            
           
            if (password_verify($password, $user['password'])) {
                $passwordMatch = true;
            }
           
            elseif ($password === $user['password']) {
                $passwordMatch = true;
                
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $GLOBALS['conn']->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->execute([$hashedPassword, $user['id']]);
            }
            
            if ($passwordMatch) {
                
                if ($user['status'] !== 'active') {
                    header('Location: ../views/login.php?error=suspended');
                    exit();
                }
                
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['userid'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                
                if ($rememberMe == '1') {
                    $cookieValue = $username . '|' . hash('sha256', $password . $user['id']);
                    $cookieExpiry = time() + (30 * 24 * 3600);
                    
                    setcookie(
                        'agrismart_remember',
                        $cookieValue,
                        $cookieExpiry,
                        '/',
                        '',
                        false,
                        true
                    );
                }
                
                
                switch ($user['role']) {
                    case 'admin':
                        header('Location: ../views/admin_dashboard.php');
                        break;
                    case 'management':
                        header('Location: ../views/management_dashboard.php');
                        break;
                    case 'expert':
                        header('Location: ../views/expert_dashboard.php');
                        break;
                    case 'farmer':
                        header('Location: ../views/farmer_dashboard.php');
                        break;
                    default:
                        header('Location: ../views/login.php?error=invalid_role');
                }
                exit();
            } else {
                
                header('Location: ../views/login.php?error=invalid');
                exit();
            }
        } else {
            
            header('Location: ../views/login.php?error=invalid');
            exit();
        }
    } catch (Exception $e) {
        
        header('Location: ../views/login.php?error=invalid');
        exit();
    }
} else {
    header('Location: ../views/login.php');
    exit();
}
?>
