<?php
// views/auth.php Combined Login & Signup
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up - AgriSmart</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <!-- Header -->
    <?php include '../assets/layouts/header.php'; ?>

    <!-- Auth Wrapper -->
    <div class="auth-wrapper">
        <div class="auth-container">
            <!-- Form Section -->
            <div class="auth-form-section">
                <!-- Login Form -->
                <div id="login-section">
                    <h2>Welcome Back!</h2>
                    <p class="subtitle">Sign in to your AgriSmart account</p>

                    <form id="loginForm" method="POST" action="login.php">
                        <div class="form-group">
                            <label for="login-email">Email Address</label>
                            <input type="email" id="login-email" name="email" placeholder="your@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="login-password">Password</label>
                            <input type="password" id="login-password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>

                        <div class="forgot-password">
                            <a href="#">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn-auth">Sign In</button>
                    </form>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    

                    <div class="auth-toggle">
                        Don't have an account? <a onclick="toggleAuthForm()">Sign Up</a>
                    </div>
                </div>

                <!-- Signup Form -->
                <div id="signup-section" class="hidden">
                    <h2>Create Account</h2>
                    <p class="subtitle">Join AgriSmart today</p>

                    <form id="signupForm" method="POST" action="signup.php">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="signup-fname">First Name</label>
                                <input type="text" id="signup-fname" name="first_name" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <label for="signup-lname">Last Name</label>
                                <input type="text" id="signup-lname" name="last_name" placeholder="Last name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="signup-email">Email Address</label>
                            <input type="email" id="signup-email" name="email" placeholder="your@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="signup-phone">Phone Number</label>
                            <input type="tel" id="signup-phone" name="phone" placeholder="+880 17XX XXXXXX" required>
                        </div>

                        <div class="form-group">
                            <label for="signup-role">User Role</label>
                            <select id="signup-role" name="role" required>
                                <option value="">Select a role</option>
                                <option value="farmer">Farmer</option>
                                <option value="expert">Agricultural Expert</option>
                                <option value="seller">Product Seller</option>
                                <option value="buyer">Buyer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="signup-password">Password</label>
                            <input type="password" id="signup-password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="form-group">
                            <label for="signup-confirm">Confirm Password</label>
                            <input type="password" id="signup-confirm" name="confirm_password" placeholder="••••••••" required>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the Terms & Conditions</label>
                        </div>

                        <button type="submit" class="btn-auth">Create Account</button>
                    </form>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    
                    <div class="auth-toggle">
                        Already have an account? <a onclick="toggleAuthForm()">Sign In</a>
                    </div>
                </div>
            </div>

            <!-- Image Section -->
            <div class="auth-image-section">
                <div class="auth-image-content">
                    <h3>🌾 Grow with AgriSmart</h3>
                    <p>Join thousands of farmers worldwide who are transforming their agriculture with smart farming solutions and expert insights.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/layouts/footer.php'; ?>

    <script>
        // Toggle between login and signup
        function toggleAuthForm() {
            const loginSection = document.getElementById('login-section');
            const signupSection = document.getElementById('signup-section');
            
            loginSection.classList.toggle('hidden');
            signupSection.classList.toggle('hidden');
        }

        // Auto-show signup if URL has #signup
        window.addEventListener('load', function() {
            if (window.location.hash === '#signup') {
                toggleAuthForm();
            }
        });

        // Form submissions
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Login form would be submitted to backend here');
            // This would connect to backend
        });

        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('signup-password').value;
            const confirm = document.getElementById('signup-confirm').value;
            
            if (password !== confirm) {
                alert('Passwords do not match!');
                return;
            }
            
            alert('Signup form would be submitted to backend here');
            // This would connect to backend
        });
    </script>
</body>
</html>