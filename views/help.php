<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & FAQ - AgriSmart</title>
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
            background-color: #f8f9fa;
            color: var(--dark);
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 2rem;
            text-align: center;
        }

        .faq-item {
            background: white;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .faq-item h3 {
            color: var(--primary);
            margin-bottom: 0.5rem;
            cursor: pointer;
            user-select: none;
        }

        .faq-item h3::before {
            content: "▶ ";
            margin-right: 0.5rem;
            transition: 0.3s;
        }

        .faq-item input[type="checkbox"] {
            display: none;
        }

        .faq-item input[type="checkbox"]:checked ~ .answer {
            display: block;
        }

        .faq-item input[type="checkbox"]:checked ~ h3::before {
            content: "▼ ";
        }

        .answer {
            display: none;
            color: #555;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .section {
            margin-bottom: 3rem;
        }

        .section h2 {
            color: var(--dark);
            border-bottom: 3px solid var(--primary);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .nav-links {
                gap: 1rem;
            }

            .faq-item {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="nav-brand">🌾 AgriSmart</a>
        <ul class="nav-links">
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=marketplace">Marketplace</a></li>
            <li><a href="index.php?page=help">Help</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>❓ Help & FAQ</h1>

        <!-- Getting Started Section -->
        <div class="section">
            <h2>Getting Started</h2>

            <div class="faq-item">
                <input type="checkbox" id="faq1">
                <label for="faq1"><h3>How do I create an account?</h3></label>
                <div class="answer">
                    <p>Click on "Sign In" in the navigation bar. You'll see two sections:</p>
                    <ul>
                        <li><strong>Create Account:</strong> Fill in your role, email, username, password, and confirm password</li>
                        <li><strong>Sign In:</strong> Use your email/username and password to log in</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq2">
                <label for="faq2"><h3>What are the different user roles?</h3></label>
                <div class="answer">
                    <ul>
                        <li><strong>Farmer:</strong> Can browse marketplace, buy inputs, track orders</li>
                        <li><strong>Expert:</strong> Can provide agricultural advice and sell products</li>
                        <li><strong>Management:</strong> Can manage farm operations and view reports</li>
                        <li><strong>Admin:</strong> Has full system access and can manage all features</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq3">
                <label for="faq3"><h3>Can I test with demo accounts?</h3></label>
                <div class="answer">
                    <p>Yes! Use these demo accounts:</p>
                    <ul>
                        <li><strong>farmer1</strong> - Password: 12345678</li>
                        <li><strong>expert1</strong> - Password: 12345678</li>
                        <li><strong>admin1</strong> - Password: 12345678</li>
                        <li><strong>management1</strong> - Password: 12345678</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Marketplace Section -->
        <div class="section">
            <h2>Marketplace</h2>

            <div class="faq-item">
                <input type="checkbox" id="faq4">
                <label for="faq4"><h3>How do I purchase products?</h3></label>
                <div class="answer">
                    <ol>
                        <li>Go to "Marketplace" page</li>
                        <li>Browse available products (seeds, fertilizers, tools, etc.)</li>
                        <li>Select quantity and click "Add to Cart"</li>
                        <li>View your cart total in the top right</li>
                        <li>Click "Proceed to Checkout" when ready</li>
                    </ol>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq5">
                <label for="faq5"><h3>What products are available?</h3></label>
                <div class="answer">
                    <p>Currently available products include:</p>
                    <ul>
                        <li><strong>Seeds:</strong> Paddy, Wheat, and more</li>
                        <li><strong>Fertilizers:</strong> Urea, DAP, Potash</li>
                        <li><strong>Pesticides:</strong> Various crop protection products</li>
                        <li><strong>Farm Tools:</strong> Complete toolkit for farming operations</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq6">
                <label for="faq6"><h3>How do I track my orders?</h3></label>
                <div class="answer">
                    <ol>
                        <li>Log in to your account</li>
                        <li>Click "Dashboard"</li>
                        <li>Scroll down to see "Your Orders" section</li>
                        <li>View order details including status and total amount</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Account Section -->
        <div class="section">
            <h2>Account & Profile</h2>

            <div class="faq-item">
                <input type="checkbox" id="faq7">
                <label for="faq7"><h3>How do I reset my password?</h3></label>
                <div class="answer">
                    <p>Currently, password reset is not available. Please use the demo accounts or create a new account with your preferred password.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq8">
                <label for="faq8"><h3>How do I logout?</h3></label>
                <div class="answer">
                    <p>Click the "Logout" button in the top right navigation bar. You'll be redirected to the home page.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq9">
                <label for="faq9"><h3>Can I change my account details?</h3></label>
                <div class="answer">
                    <p>Profile editing feature coming soon! For now, you can create a new account if you need to change your information.</p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="section">
            <h2>Features</h2>

            <div class="faq-item">
                <input type="checkbox" id="faq10">
                <label for="faq10"><h3>What features are available?</h3></label>
                <div class="answer">
                    <ul>
                        <li>✅ User Registration & Authentication</li>
                        <li>✅ Marketplace with multiple products</li>
                        <li>✅ Shopping Cart System</li>
                        <li>✅ Order Management</li>
                        <li>✅ Role-based Dashboards</li>
                        <li>🚧 Smart Irrigation Advisor (Coming Soon)</li>
                        <li>🚧 Disease Detection (Coming Soon)</li>
                        <li>🚧 Expert Chat (Coming Soon)</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq11">
                <label for="faq11"><h3>When will more features be added?</h3></label>
                <div class="answer">
                    <p>We're actively developing more features! Check back regularly for updates. Features like Smart Irrigation, Disease Detection, and Expert Chat are in the roadmap.</p>
                </div>
            </div>
        </div>

        <!-- Support Section -->
        <div class="section">
            <h2>Support</h2>

            <div class="faq-item">
                <input type="checkbox" id="faq12">
                <label for="faq12"><h3>I'm encountering an error. What should I do?</h3></label>
                <div class="answer">
                    <ol>
                        <li>Clear your browser cache and cookies</li>
                        <li>Try again in a private/incognito window</li>
                        <li>Ensure JavaScript is enabled in your browser</li>
                        <li>Check if you're using a compatible browser (Chrome, Firefox, Safari, Edge)</li>
                    </ol>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq13">
                <label for="faq13"><h3>How can I provide feedback?</h3></label>
                <div class="answer">
                    <p>We'd love to hear from you! Your feedback helps us improve AgriSmart. Contact our support team with your suggestions and ideas.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq14">
                <label for="faq14"><h3>Is my data secure?</h3></label>
                <div class="answer">
                    <p>We take security seriously. All sensitive information is handled carefully. However, this is a demo application. For production use, additional security measures should be implemented.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
