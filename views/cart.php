<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/cartModel.php');
$cartItems = getCartItems($_SESSION['user_id']);
$total = getCartTotal($_SESSION['user_id']);

$pageTitle = "Shopping Cart";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'updated') echo 'Cart updated!';
            elseif($_GET['success'] == 'removed') echo 'Item removed from cart!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <h2>My Shopping Cart</h2>
</div>

<?php if(count($cartItems) > 0): ?>
    <div class="content-box">
        <div class="cart-items">
            <?php foreach($cartItems as $item): ?>
                <div class="cart-item">
                    <div>
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Category: <?php echo $item['category']; ?> | Price: ৳<?php echo number_format($item['price'], 2); ?></p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <form method="post" action="../controllers/updateCartQuantity.php" style="display: flex; gap: 10px;">
                            <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="<?php echo $item['stock']; ?>" style="width: 70px; padding: 8px;">
                            <button type="submit" name="submit" class="btn-small">Update</button>
                        </form>
                        <div>
                            <strong>৳<?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong>
                        </div>
                        <a href="../controllers/removeFromCart.php?id=<?php echo $item['id']; ?>" class="btn-small btn-danger" onclick="return confirm('Remove from cart?')">Remove</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="content-box">
        <div class="cart-summary">
            <h3>Total: ৳<?php echo number_format($total, 2); ?></h3>
            <a href="checkout.php" class="btn btn-large">Proceed to Checkout</a>
            <a href="shop.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 4em;">🛒</div>
            <h2>Your cart is empty</h2>
            <p>Add products from the shop to get started</p>
            <a href="shop.php" class="btn">Go to Shop</a>
        </div>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
