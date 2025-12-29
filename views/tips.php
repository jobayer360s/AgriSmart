<?php
// views/tips.php - Tips & Resources Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tips & Resources - AgriSmart Knowledge Hub</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/tips.css">
</head>
<body>
  
    <?php include '../assets/layouts/header.php'; ?>

 
    <section class="tips-hero">
        <h1>🌾 Knowledge Hub</h1>
        <p>Educational resources to help you improve your farming practices</p>
    </section>

    <section class="featured-section">
        <h2 class="featured-title">📌 Featured Article</h2>
        <div class="featured-container">
            <div class="featured-image">
                <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=500&h=300&fit=crop" alt="Regenerative agriculture">
                <span class="featured-badge">Featured</span>
            </div>

            <div class="featured-content">
                <div style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">Climate Smart</div>
                <h2>Success Story: Transitioning to Regenerative Agriculture</h2>
                <div class="featured-meta">
                    <span>📅 Aug 28, 2023</span>
                    <span>⏱️ 10 min read</span>
                </div>
                <p>Five years ago, John Anderson's farm was struggling with declining yields and rising input costs. Today, his farm is thriving with higher profits and improved soil health. This case study explores how John successfully transitioned from conventional to regenerative agriculture methods, the challenges he faced, and the lessons learned along the way.</p>
                <div class="featured-tags">
                    <span class="tag">regenerative agriculture</span>
                    <span class="tag">sustainability</span>
                    <span class="tag">success story</span>
                </div>
                <p style="font-weight: 600; margin-top: 1rem;">Regenerative Farming Network</p>
                <a href="#" class="read-btn">Read Full Article →</a>
            </div>
        </div>
    </section>

  
    <section class="resources-section">
        <div class="filter-section">
            <div class="filter-title">Filter Resources</div>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All Resources</button>
                <button class="filter-btn" data-filter="article">Articles</button>
                <button class="filter-btn" data-filter="video">Videos</button>
                <button class="filter-btn" data-filter="tool">Tools</button>
                <button class="filter-btn" data-filter="guide">Guides</button>
            </div>
        </div>

       
        <h2 class="section-title">💡 All Resources</h2>
        <div class="view-all">
            <a href="#">View All →</a>
        </div>

        <div class="resources-grid">
            
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad576?w=300&h=180&fit=crop" alt="Corn farming">
                    <span class="resource-type article">Article</span>
                </div>
                <div class="resource-content">
                    <h3>Maximizing Corn Yields: A Comprehensive Guide</h3>
                    <p>Learn proven techniques to increase your corn yields while maintaining soil health and sustainability.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">📖 12 min read</span>
                        <span class="resource-author">Dr. Sarah Johnson</span>
                    </div>
                </div>
            </div>

            <!-- Resource 2 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=300&h=180&fit=crop" alt="Irrigation system">
                    <span class="resource-type video">Video</span>
                </div>
                <div class="resource-content">
                    <h3>Center Pivot Irrigation Systems: Installation and Maintenance</h3>
                    <p>A step-by-step video guide on setting up and maintaining efficient center pivot irrigation systems.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">⏱️ 25:35</span>
                        <span class="resource-author">James Carter</span>
                    </div>
                </div>
            </div>

            <!-- Resource 3 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1557804506-669714d2e9d8?w=300&h=180&fit=crop" alt="Crop calendar">
                    <span class="resource-type tool">Tool</span>
                </div>
                <div class="resource-content">
                    <h3>Seasonal Crop Calendar for Midwest Farmers</h3>
                    <p>Interactive calendar showing optimal planting and harvesting times for major crop varieties.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">📅 Interactive</span>
                        <span class="resource-author">Farm Services</span>
                    </div>
                </div>
            </div>

            <!-- Resource 4 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1559027615-cd2628902d4a?w=300&h=180&fit=crop" alt="Disease management">
                    <span class="resource-type guide">Guide</span>
                </div>
                <div class="resource-content">
                    <h3>Identifying and Managing Soybean Diseases</h3>
                    <p>Visual guide to common soybean diseases with organic and conventional treatment options.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">📘 Guide</span>
                        <span class="resource-author">Plant Pathology Dept.</span>
                    </div>
                </div>
            </div>

            <!-- Resource 5 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=300&h=180&fit=crop" alt="Soil testing">
                    <span class="resource-type article">Article</span>
                </div>
                <div class="resource-content">
                    <h3>Soil Testing: Why, When, and How</h3>
                    <p>Learn the importance of regular soil testing and how to interpret results for better crop planning.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">📖 15 min</span>
                        <span class="resource-author">Dr. Emily Thompson</span>
                    </div>
                </div>
            </div>

            <!-- Resource 6 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1588287537317-aeb51a1a9c0c?w=300&h=180&fit=crop" alt="Organic certification">
                    <span class="resource-type video">Video</span>
                </div>
                <div class="resource-content">
                    <h3>Organic Certification Process Explained</h3>
                    <p>Step-by-step guide to obtaining organic certification for your farm, including compliance requirements.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">⏱️ 20 min</span>
                        <span class="resource-author">Organic Farming Assoc.</span>
                    </div>
                </div>
            </div>

            <!-- Resource 7 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1603281826661-8fe3fbfaa99f?w=300&h=180&fit=crop" alt="Drone technology">
                    <span class="resource-type tool">Tool</span>
                </div>
                <div class="resource-content">
                    <h3>Using Drones for Precision Agriculture: Beginner's Guide</h3>
                    <p>Introduction to agricultural drone technology and how it can help improve your farming efficiency.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">📘 Guide</span>
                        <span class="resource-author">Tech Farming USA</span>
                    </div>
                </div>
            </div>

            <!-- Resource 8 -->
            <div class="resource-card">
                <div class="resource-image">
                    <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=300&h=180&fit=crop" alt="Case study">
                    <span class="resource-type guide">Case Study</span>
                </div>
                <div class="resource-content">
                    <h3>Success Story: Transitioning to Regenerative Agriculture</h3>
                    <p>Case study of a farmer who successfully transitioned from conventional to regenerative farming methods.</p>
                    <div class="resource-meta">
                        <span class="resource-duration">📅 Oct 5, 2023</span>
                        <span class="resource-author">Regenerative Network</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../assets/layouts/footer.php'; ?>

    <script>
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // Add filtering logic here
            });
        });
    </script>
</body>
</html>
