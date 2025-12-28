<?php
// views/marketplace.php - Marketplace Products Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - Buy Seeds, Fertilizers & Tools</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/marketplace.css">
</head>
<body>
    <!-- Header -->
    <?php include '../assets/layouts/header.php'; ?>

    <!-- Marketplace Hero -->
    <section class="marketplace-hero">
        <h1>🛒 Input Marketplace</h1>
        <p>Quality seeds, fertilizers, and farming tools at competitive prices</p>
    </section>

    <!-- Search & Filter Section -->
    <section class="search-filter">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search for seeds, fertilizers, tools...">
            <button class="search-btn">🔍 Search</button>
        </div>

        <div class="filter-controls">
            <select class="filter-dropdown">
                <option value="">All Categories</option>
                <option value="seeds">Seeds</option>
                <option value="fertilizers">Fertilizers</option>
                <option value="tools">Tools</option>
                <option value="pesticides">Pesticides</option>
                <option value="equipment">Equipment</option>
            </select>

            <select class="filter-dropdown">
                <option value="">Sort By</option>
                <option value="newest">Newest</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="rating">Highest Rated</option>
            </select>

            <select class="filter-dropdown">
                <option value="">Price Range</option>
                <option value="0-500">৳0 - ৳500</option>
                <option value="500-2000">৳500 - ৳2,000</option>
                <option value="2000-5000">৳2,000 - ৳5,000</option>
                <option value="5000+">৳5,000+</option>
            </select>
        </div>

        <div class="filter-tags">
            <span class="filter-tag">Organic Seeds <button>×</button></span>
            <span class="filter-tag">In Stock <button>×</button></span>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
        <h2 class="section-title">Featured Products</h2>

        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1585021072385-cf202db33731?w=300&h=200&fit=crop" alt="Hybrid Rice Seeds">
                    <span class="stock-badge in-stock">In Stock</span>
                    <button class="wishlist-btn">♡</button>
                </div>
                <div class="product-info">
                    <h3>Hybrid Rice Seeds (Premium)</h3>
                    <p class="seller">Sold by Green Harvest Ltd.</p>
                    <div class="rating">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="review-count">(248 reviews)</span>
                    </div>
                    <div class="price-section">
                        <span class="price">৳450</span>
                        <span class="original-price">৳650</span>
                    </div>
                    <button class="add-to-cart-btn">🛒 Add to Cart</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1595400769383-5dd96c20fdec?w=300&h=200&fit=crop" alt="NPK Fertilizer">
                    <span class="stock-badge in-stock">In Stock</span>
                    <button class="wishlist-btn">♡</button>
                </div>
                <div class="product-info">
                    <h3>NPK Fertilizer (20-20-20)</h3>
                    <p class="seller">Sold by AgroChemical BD</p>
                    <div class="rating">
                        <span class="stars">⭐⭐⭐⭐</span>
                        <span class="review-count">(187 reviews)</span>
                    </div>
                    <div class="price-section">
                        <span class="price">৳1,200</span>
                        <span class="original-price">৳1,500</span>
                    </div>
                    <button class="add-to-cart-btn">🛒 Add to Cart</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1580829343991-7763338ba89f?w=300&h=200&fit=crop" alt="Hand Hoe">
                    <span class="stock-badge low-stock">Low Stock</span>
                    <button class="wishlist-btn">♡</button>
                </div>
                <div class="product-info">
                    <h3>Traditional Hand Hoe</h3>
                    <p class="seller">Sold by Farm Tools Co.</p>
                    <div class="rating">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="review-count">(312 reviews)</span>
                    </div>
                    <div class="price-section">
                        <span class="price">৳350</span>
                        <span class="original-price">৳450</span>
                    </div>
                    <button class="add-to-cart-btn">🛒 Add to Cart</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1599599810694-b5ac4dd40a90?w=300&h=200&fit=crop" alt="Neem Oil Pesticide">
                    <span class="stock-badge in-stock">In Stock</span>
                    <button class="wishlist-btn">♡</button>
                </div>
                <div class="product-info">
                    <h3>Organic Neem Oil Pesticide</h3>
                    <p class="seller">Sold by BioSolutions</p>
                    <div class="rating">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="review-count">(425 reviews)</span>
                    </div>
                    <div class="price-section">
                        <span class="price">৳580</span>
                        <span class="original-price">৳750</span>
                    </div>
                    <button class="add-to-cart-btn">🛒 Add to Cart</button>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1555449696-4c5b45d9e866?w=300&h=200&fit=crop" alt="Drip Irrigation Kit">
                    <span class="stock-badge in-stock">In Stock</span>
                    <button class="wishlist-btn">♡</button>
                </div>
                <div class="product-info">
                    <h3>Drip Irrigation Kit (100m)</h3>
                    <p class="seller">Sold by IrrigationPro</p>
                    <div class="rating">
                        <span class="stars">⭐⭐⭐⭐</span>
                        <span class="review-count">(156 reviews)</span>
                    </div>
                    <div class="price-section">
                        <span class="price">৳2,800</span>
                        <span class="original-price">৳3,500</span>
                    </div>
                    <button class="add-to-cart-btn">🛒 Add to Cart</button>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=300&h=200&fit=crop" alt="Wheat Seeds">
                    <span class="stock-badge in-stock">In Stock</span>
                    <button class="wishlist-btn">♡</button>
                </div>
                <div class="product-info">
                    <h3>High-Yield Wheat Seeds</h3>
                    <p class="seller">Sold by SeedBank BD</p>
                    <div class="rating">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="review-count">(389 reviews)</span>
                    </div>
                    <div class="price-section">
                        <span class="price">৳380</span>
                        <span class="original-price">৳520</span>
                    </div>
                    <button class="add-to-cart-btn">🛒 Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Shop With Us Section -->
    <section class="why-shop">
        <h2>Why Shop with AgriSmart Marketplace?</h2>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">✓</div>
                <h3>Quality Assured</h3>
                <p>All products verified and tested by agriculture experts</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">✓</div>
                <h3>Best Prices</h3>
                <p>Direct from suppliers, no middlemen</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">✓</div>
                <h3>Fast Delivery</h3>
                <p>Quick delivery across Bangladesh within 3-5 days</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">✓</div>
                <h3>Expert Support</h3>
                <p>Get product recommendations from farming experts</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../assets/layouts/footer.php'; ?>

    <script>
        // Add to cart functionality
        const cartBtns = document.querySelectorAll('.add-to-cart-btn');
        cartBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                this.textContent = '✓ Added to Cart';
                this.style.backgroundColor = '#4a9e4a';
                setTimeout(() => {
                    this.textContent = '🛒 Add to Cart';
                    this.style.backgroundColor = '';
                }, 2000);
            });
        });

        // Wishlist functionality
        const wishlistBtns = document.querySelectorAll('.wishlist-btn');
        wishlistBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                this.textContent = this.textContent === '♡' ? '♥' : '♡';
                this.style.color = this.textContent === '♥' ? '#e74c3c' : '';
            });
        });
    </script>
</body>
</html>