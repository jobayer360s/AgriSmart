<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/shopProductModel.php');

if(!isset($_GET['id'])){
    header('location: manage_products.php');
    exit;
}

$product = getShopProductById($_GET['id']);
if(!$product){
    header('location: manage_products.php?error=not_found');
    exit;
}

$pageTitle = "Edit Product";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Edit Product: <?php echo htmlspecialchars($product['name']); ?></h2>
    
    <form method="post" action="../controllers/updateShopProduct.php" class="form-style">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Product Name *</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="Fertilizer" <?php echo $product['category']=='Fertilizer'?'selected':''; ?>>Fertilizer</option>
                    <option value="Seeds" <?php echo $product['category']=='Seeds'?'selected':''; ?>>Seeds</option>
                    <option value="Pesticides" <?php echo $product['category']=='Pesticides'?'selected':''; ?>>Pesticides</option>
                    <option value="Tools" <?php echo $product['category']=='Tools'?'selected':''; ?>>Tools</option>
                    <option value="Equipment" <?php echo $product['category']=='Equipment'?'selected':''; ?>>Equipment</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Price (৳) *</label>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label>Stock Quantity *</label>
                <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
            </div>
        </div>
        
        <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" name="supplier" value="<?php echo htmlspecialchars($product['supplier_name']); ?>">
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update Product</button>
            <a href="manage_products.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
