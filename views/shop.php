<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/shopProductModel.php');
$products = getAllShopProducts();

$pageTitle = "Shop Products";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Product added to cart!</div>
<?php endif; ?>

<div class="content-box">
    <h2>Shop Agricultural Products</h2>
    <p>Browse and order fertilizers, seeds, tools, and equipment</p>
</div>

<div class="content-box">
    <div class="products-grid">
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <div class="product-header">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <span class="badge"><?php echo $product['category']; ?></span>
                </div>
                
                <div class="product-desc">
                    <?php echo htmlspecialchars($product['description']); ?>
                </div>
                
                <div class="product-meta">
                    <span>Stock: <strong><?php echo $product['stock']; ?></strong></span>
                    <span>Supplier: <?php echo htmlspecialchars($product['supplier_name']); ?></span>
                </div>
                
                <div class="product-footer">
                    <div class="product-price">৳<?php echo number_format($product['price'], 2); ?></div>
                    <?php if($product['stock'] > 0): ?>
                        <form method="post" action="../controllers/addToCart.php" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>" style="width: 60px; padding: 5px; margin-right: 5px;">
                            <button type="submit" name="submit" class="btn-small">Add to Cart</button>
                        </form>
                    <?php else: ?>
                        <span style="color: #dc3545;">Out of Stock</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
