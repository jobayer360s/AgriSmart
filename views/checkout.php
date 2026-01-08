<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/cartModel.php');
require_once(__DIR__ . '/../models/userModel.php');

$cartItems = getCartItems($_SESSION['user_id']);
$total = getCartTotal($_SESSION['user_id']);
$user = getUserById($_SESSION['user_id']);

if(count($cartItems) == 0){
    header('location: cart.php');
    exit;
}

$pageTitle = "Checkout";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Checkout</h2>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
    <div class="content-box">
        <h3>Delivery Information</h3>
        <form method="post" action="../controllers/placeOrder.php" class="form-style">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Phone Number *</label>
                <input type="text" name="phone" required>
            </div>
            
            <div class="form-group">
                <label>Delivery Address *</label>
                <textarea name="address" rows="4" placeholder="Enter complete address with village, district" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Payment Method</label>
                <select name="payment_method" required>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Additional Notes</label>
                <textarea name="notes" rows="2" placeholder="Any special instructions..."></textarea>
            </div>
            
            <button type="submit" name="submit" class="btn btn-large btn-full">Place Order</button>
        </form>
    </div>
    
    <div>
        <div class="content-box">
            <h3>Order Summary</h3>
            <div style="margin-top: 20px;">
                <?php foreach($cartItems as $item): ?>
                    <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                        <span><?php echo htmlspecialchars($item['name']); ?> x<?php echo $item['quantity']; ?></span>
                        <span>৳<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
                
                <div style="display: flex; justify-content: space-between; padding: 15px 0; font-size: 1.2em; font-weight: bold; border-top: 2px solid #333; margin-top: 10px;">
                    <span>Total</span>
                    <span style="color: #28a745;">৳<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
