<?php
// Get auth controller from globals
$auth = $GLOBALS['auth'] ?? null;

$error = '';
$success = '';

// Handle form submission ONLY for signup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'signup') {
    $result = $auth->signup(
        trim($_POST['email'] ?? ''),
        trim($_POST['username'] ?? ''),
        trim($_POST['password'] ?? ''),
        trim($_POST['confirm_password'] ?? ''),
        trim($_POST['role'] ?? '')
    );

    if ($result['success']) {
        $success = $result['message'] ?? 'Account created successfully! Redirecting to sign in...';
        // Redirect after 2 seconds
        header('Refresh: 2; URL=index.php?page=signin');
    } else {
        $error = $result['errors'] ?? $result['message'] ?? 'Signup failed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - AgriSmart</title>
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
            max-width: 500px;
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

        input, select {
            width: 100%;
            padding: 0.85rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            transition: 0.3s;
        }

        input:focus, select:focus {
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

        .alert ul {
            margin: 0.5rem 0 0 1.5rem;
            padding: 0;
        }

        .alert li {
            margin: 0.3rem 0;
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

        .small-text {
            color: #666;
            margin-top: 0.25rem;
            display: block;
            font-size: 0.85rem;
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
            <h1>📝 Create Account</h1>
            <p>Join AgriSmart Today</p>
        </div>

        <?php if ($error && isset($_POST['action']) && $_POST['action'] === 'signup'): ?>
            <div class="alert alert-error">
                <?php if (is_array($error)): ?>
                    <strong>❌ Errors:</strong>
                    <ul>
                    <?php foreach ($error as $field => $msg): ?>
                        <li><?php echo htmlspecialchars($msg); ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    ❌ <?php echo htmlspecialchars($error); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                ✅ <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="action" value="signup">

            <div class="form-group">
                <label>👤 Select Your Role</label>
                <select name="role" required>
                    <option value="">-- Choose Your Role --</option>
                    <option value="farmer">👨‍🌾 Farmer</option>
                    <option value="expert">👨‍💼 Agricultural Expert</option>
                    <option value="management">👔 Management</option>
                    <option value="admin">🔐 Administrator</option>
                </select>
            </div>

            <div class="form-group">
                <label>📧 Email Address</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>

            <div class="form-group">
                <label>👤 Username</label>
                <input type="text" name="username" placeholder="username" required minlength="3">
                <span class="small-text">Min 3 characters, letters and numbers only</span>
            </div>

            <div class="form-group">
                <label>🔐 Password</label>
                <input type="password" name="password" placeholder="••••••••" required minlength="8">
                <span class="small-text">Min 8 characters</span>
            </div>

            <div class="form-group">
                <label>🔐 Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="••••••••" required minlength="8">
            </div>

            <button type="submit" class="btn">Create Account</button>
        </form>

        <div class="info-box">
            <strong>ℹ️ Password Requirements:</strong>
            At least 8 characters<br>
            Use letters and numbers
        </div>

        <div class="divider">Already have an account?</div>

        <div class="links">
            <a href="index.php?page=signin" class="btn-link">Sign In →</a>
            <a href="index.php?page=home" class="btn-link">← Back to Home</a>
        </div>
    </div>
</body>
</html>
