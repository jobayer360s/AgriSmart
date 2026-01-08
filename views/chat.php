<?php
session_start();
require_once('../models/db.php');

// ✅ FOR LOGGED-IN USERS: Get cart from DATABASE (Session)
if(isset($_SESSION['user_id'])) {
    require_once('../models/cartModel.php');
    $cartItems = getCartItems($_SESSION['user_id']);
    $cartTotal = getCartTotal($_SESSION['user_id']);
    $isGuest = false;
} 
// 🍪 FOR GUEST USERS: Get cart from COOKIE
else {
    $guestCart = isset($_COOKIE['guest_cart']) ? json_decode($_COOKIE['guest_cart'], true) : [];
    $cartItems = [];
    $cartTotal = 0;
    $isGuest = true;
    
    // Convert guest cart cookie to display format
    if(!empty($guestCart)) {
        require_once('../models/productModel.php');
        foreach($guestCart as $productId => $item) {
            $product = getProductById($productId);
            if($product) {
                $cartItems[] = [
                    'id' => $productId,
                    'product_id' => $productId,
                    'product_name' => $product['name'],
                    'price' => $product['price'],
                    'category' => $product['category'],
                    'stock' => $product['stock'],
                    'quantity' => $item['quantity']
                ];
                $cartTotal += $product['price'] * $item['quantity'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart - AgriSmart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../assets/includes/header.php'); ?>
    
    <div class="container">
        <div class="page-header">
            <h2>My Shopping Cart</h2>
            <a href="shop.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
        
        <!-- 🍪 GUEST USER NOTICE -->
        <?php if($isGuest && !empty($cartItems)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                You are browsing as a guest. <a href="../login.php">Login</a> to save your cart and checkout.
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                switch($_GET['success']) {
                    case 'added': echo 'Product added to cart!'; break;
                    case 'updated': echo 'Cart updated successfully!'; break;
                    case 'removed': echo 'Item removed from cart!'; break;
                }
                ?>
            </div>
        <?php endif; ?>
        
        <?php if(empty($cartItems)): ?>
            <div class="alert alert-info">
                Your cart is empty. <a href="shop.php">Start shopping now!</a>
            </div>
        <?php else: ?>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Cart Items (<?= count($cartItems) ?>)</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cartItems as $item): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($item['product_name']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($item['category']) ?></small>
                                    </td>
                                    <td>৳<?= number_format($item['price'], 2) ?></td>
                                    <td>
                                        <?php if(!$isGuest): ?>
                                        <!-- Logged-in user: Update via form -->
                                        <form action="../controllers/updateCartQuantity.php" method="POST" class="d-inline">
                                            <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" 
                                                   min="1" max="<?= $item['stock'] ?>" 
                                                   class="form-control form-control-sm" 
                                                   style="width: 80px; display: inline;"
                                                   onchange="this.form.submit()">
                                        </form>
                                        <?php else: ?>
                                        <!-- Guest user: Show quantity only (no update) -->
                                        <span><?= $item['quantity'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong>৳<?= number_format($item['price'] * $item['quantity'], 2) ?></strong></td>
                                    <td>
                                        <?php if(!$isGuest): ?>
                                        <a href="../controllers/removeFromCart.php?id=<?= $item['id'] ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Remove this item?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <?php else: ?>
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="removeGuestCartItem(<?= $item['product_id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>Subtotal:</td>
                                <td class="text-right">৳<?= number_format($cartTotal, 2) ?></td>
                            </tr>
                            <tr>
                                <td>Delivery Fee:</td>
                                <td class="text-right">৳50.00</td>
                            </tr>
                            <tr class="border-top">
                                <td><strong>Total:</strong></td>
                                <td class="text-right"><strong>৳<?= number_format($cartTotal + 50, 2) ?></strong></td>
                            </tr>
                        </table>
                        
                        <?php if(!$isGuest): ?>
                        <a href="checkout.php" class="btn btn-primary btn-block">
                            <i class="fas fa-shopping-cart"></i> Proceed to Checkout
                        </a>
                        <?php else: ?>
                        <a href="/login.php" class="btn btn-primary btn-block">
                            <i class="fas fa-sign-in-alt"></i> Login to Checkout
                        </a>
                        <a href="/signup.php" class="btn btn-secondary btn-block">
                            Create Account
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- 🍪 JAVASCRIPT FOR GUEST CART REMOVAL -->
    <script>
    function removeGuestCartItem(productId) {
        if(confirm('Remove this item?')) {
            // Get guest cart cookie
            let guestCart = getCookie('guest_cart');
            if(guestCart) {
                let cart = JSON.parse(guestCart);
                delete cart[productId];
                
                // Update cookie
                document.cookie = `guest_cart=${JSON.stringify(cart)}; max-age=${86400*7}; path=/`;
                location.reload();
            }
        }
    }
    
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }
    </script>
    
    <?php include('../assets/includes/footer.php'); ?>
</body>
</html>
