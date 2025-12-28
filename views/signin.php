<?php
// Get auth controller from globals
$auth = $GLOBALS['auth'] ?? null;

$error = '';
$success = '';

// Handle form submission ONLY for signin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'signin') {
    $emailOrUsername = trim($_POST['email_or_username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate inputs exist
    if (empty($emailOrUsername) || empty($password)) {
        $error = 'Please enter both email/username and password';
    } else {
        // Try to sign in
        $result = $auth->signin($emailOrUsername, $password);
        
        if ($result['success']) {
            header('Location: index.php?page=dashboard');
            exit;
        } else {
            $error = $result['message'] ?? 'Invalid email/username or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - AgriSmart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2ecc71;
            --secondary: #27ae60;
            --dark: #2c3e50;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }

        .nav-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .container {
            background: white;
            padding: 3rem 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 0.85rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(46, 204, 113, 0.3);
        }

        .btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(46, 204, 113, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196F3;
            padding: 1rem;
            margin-top: 2rem;
            border-radius: 5px;
            font-size: 0.9rem;
            color: #1565c0;
        }

        .info-box strong {
            display: block;
            margin-bottom: 0.5rem;
            color: #0d47a1;
        }

        .demo-account {
            background: white;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border-left: 3px solid var(--primary);
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
        }

        .demo-account .username {
            color: var(--primary);
            font-weight: bold;
        }

        .demo-account .password {
            color: #27ae60;
            font-weight: bold;
        }

        .divider {
            text-align: center;
            margin: 2rem 0 1.5rem 0;
            color: #999;
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            display: block;
            height: 1px;
            background: #ddd;
            margin-bottom: 1rem;
        }

        .divider::after {
            content: '';
            display: block;
            height: 1px;
            background: #ddd;
            margin-top: 1rem;
        }

        .links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            text-align: center;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 5px;
            transition: 0.3s;
        }

        .links a:hover {
            background: #f0f0f0;
            text-decoration: underline;
        }

        .links a.btn-link {
            background: #f0f0f0;
            color: var(--dark);
            display: block;
        }

        .links a.btn-link:hover {
            background: #e0e0e0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 2rem 1.5rem;
                margin-top: 5rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .links {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php" class="nav-brand">🌾 AgriSmart</a>
    </div>

    <div class="container">
        <div class="header">
            <h1>🔓 Sign In</h1>
            <p>Welcome back to AgriSmart</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error">
                ❌ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="action" value="signin">

            <div class="form-group">
                <label>📧 Email or Username</label>
                <input type="text" name="email_or_username" placeholder="Enter your email or username" required autofocus>
            </div>

            <div class="form-group">
                <label>🔐 Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn">Sign In</button>
        </form>

        <!-- Demo Accounts Info -->
        <div class="info-box">
            <strong>📌 Demo Accounts (for testing):</strong>
            
            <div class="demo-account">
                <span class="username">farmer1</span><br>
                Password: <span class="password">12345678</span>
            </div>

            <div class="demo-account">
                <span class="username">expert1</span><br>
                Password: <span class="password">12345678</span>
            </div>

            <div class="demo-account">
                <span class="username">admin1</span><br>
                Password: <span class="password">12345678</span>
            </div>

            <div class="demo-account">
                <span class="username">management1</span><br>
                Password: <span class="password">12345678</span>
            </div>
        </div>

        <div class="divider">New to AgriSmart?</div>

        <div class="links">
            <a href="index.php?page=signup" class="btn-link">Create Account →</a>
            <a href="index.php?page=home" class="btn-link">← Back to Home</a>
        </div>
    </div>
</body>
</html>
