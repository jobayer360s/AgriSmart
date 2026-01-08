<?php
session_start();

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
    <title>Sign Up - AgriSmart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>🌾 Create Account</h2>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <?php
                        if($_GET['error'] == 'username_exists') echo 'Username already exists!';
                        elseif($_GET['error'] == 'email_exists') echo 'Email already registered!';
                        elseif($_GET['error'] == 'failed') echo 'Registration failed! Please try again.';
                    ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="../controllers/signupCheck.php" class="form-style">
                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" placeholder="Choose a username" required autofocus>
                </div>
                
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" placeholder="Create a password" required>
                </div>
                
                <div class="form-group">
                    <label>Register As *</label>
                    <select name="role" required>
                        <option value="farmer">Farmer</option>
                        <option value="expert">Expert</option>
                    </select>
                    <small style="color: #666; font-size: 0.85em;">Select your role in the system</small>
                </div>
                
                <button type="submit" name="submit" class="btn">Create Account</button>
            </form>
            
            <div class="auth-footer">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>
