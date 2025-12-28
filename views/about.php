<?php
// views/about.php - About Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About AgriSmart - About Us</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/about.css">
</head>
<body>
    <!-- Header -->
    <?php include '../assets/layouts/header.php'; ?>

    <!-- About Hero -->
    <section class="about-hero">
        <h1>About AgriSmart</h1>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="mission-container">
            <div class="mission-text">
                <h2>Our Mission</h2>
                <p>AgriSmart is dedicated to empowering farmers with AI-driven insights and tools that make sustainable and profitable farming accessible to everyone, regardless of farm size or technical expertise.</p>
                <p>We believe that by combining cutting-edge artificial intelligence with agricultural science, we can help address global food security challenges while promoting environmentally responsible farming practices.</p>
                <p>Our team of agricultural experts, data scientists, and software engineers work together to create intuitive tools that translate complex data into actionable farming recommendations.</p>
            </div>
            <div class="mission-image">
                <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad576?w=500&h=400&fit=crop" alt="Team working in field">
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <h2 class="section-title">Our Team</h2>
        <div class="team-grid">
            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop" alt="Dr. Emily Chen">
                <h3>Sujana</h3>
                <div class="role">Founder & CEO</div>
                <p>Agricultural scientist with 15 years of experience in sustainable farming systems.</p>
            </div>

            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop" alt="Michael Rodriguez">
                <h3>Rifat</h3>
                <div class="role">CTO</div>
                <p>AI specialist focused on applying machine learning to agricultural challenges.</p>
            </div>

            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop" alt="Priya Sharma">
                <h3>Tajin</h3>
                <div class="role">Head of Agronomy</div>
                <p>Expert in crop science and soil health with a passion for regenerative agriculture.</p>
            </div>

            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop" alt="James Wilson">
                <h3>Jubayer</h3>
                <div class="role">Lead Engineer</div>
                <p>Software architect specializing in IoT systems and data visualization.</p>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <h2 class="section-title">Our Partners</h2>
        <p class="partners-description">We collaborate with leading agricultural institutions, technology providers, and sustainability organizations to bring the best solutions to farmers worldwide.</p>
        <div class="partners-grid">
            <div class="partner-card">
                <div class="partner-logo">🌾</div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">🔬</div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">🌱</div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">📊</div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <h2 class="section-title">Get In Touch</h2>
        <div class="contact-container">
            <form class="contact-form">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Send Message</button>
            </form>

            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>info@agrismart.com</p>
                        <p>support@agrismart.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <h3>Phone</h3>
                        <p>+880 1700 000000</p>
                        <p>+880 1800 000000</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <h3>Address</h3>
                        <p>Dhaka, Bangladesh</p>
                        <p>Tech Park, Innovation Hub</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">⏰</div>
                    <div class="info-content">
                        <h3>Working Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                        <p>Saturday - Sunday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../assets/layouts/footer.php'; ?>
</body>
</html>