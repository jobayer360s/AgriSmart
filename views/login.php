<?php
session_start();


$rememberUsername = '';
if (isset($_COOKIE['agrismart_remember'])) {
    list($cookieUsername) = explode('|', $_COOKIE['agrismart_remember'], 2);
    $rememberUsername = htmlspecialchars($cookieUsername);
}


if(isset($_SESSION['user_id'])) {
    switch($_SESSION['role']) {
        case 'admin':
            header('location: admin_dashboard.php');
            break;
        case 'management':
            header('location: management_dashboard.php');
            break;
        case 'expert':
            header('location: expert_dashboard.php');
            break;
        case 'farmer':
            header('location: farmer_dashboard.php');
            break;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AgriSmart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>🌾 AgriSmart Login</h2>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <?php
                        if($_GET['error'] == 'invalid') echo 'Invalid username or password!';
                        elseif($_GET['error'] == 'suspended') echo 'Your account has been suspended!';
                        elseif($_GET['error'] == 'invalid_role') echo 'Invalid user role!';
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?php
                        if($_GET['success'] == 'registered') echo 'Registration successful! Please login.';
                        elseif($_GET['success'] == 'logged_out') echo 'You have been logged out successfully!';
                    ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="../controllers/loginCheck.php" class="form-style">
                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" placeholder="Enter your username" 
                           value="<?php echo $rememberUsername; ?>" required autofocus>
                </div>
                
                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                
                 <label>
                        <input type="checkbox" name="remember_me" value="1"> Remember me
                    </label>
                
                <button type="submit" name="submit" class="btn">Login</button>
            </form>
            
            <div class="auth-footer">
                Don't have an account? <a href="signup.php">Register here</a>
            </div>
            
        </div>
    </div>
</body>
</html>
