<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/shopProductModel.php');
$products = getAllShopProducts();

$pageTitle = "Manage Shop Products";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'added') echo 'Product added successfully!';
            elseif($_GET['success'] == 'updated') echo 'Product updated successfully!';
            elseif($_GET['success'] == 'deleted') echo 'Product deleted successfully!';
        ?>
    </div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert alert-error">Action failed!</div>
<?php endif; ?>

<div class="content-box">
    <div class="box-header">
        <h2>All Shop Products (<?php echo count($products); ?>)</h2>
        <button onclick="toggleForm('addForm')" class="btn">Add New Product</button>
    </div>
    
    <!-- Search with AJAX -->
    <div style="margin: 20px 0;">
        <input type="text" id="searchProduct" placeholder="Search products by name, category, or supplier..." style="padding: 10px; width: 100%; max-width: 500px; border: 2px solid #e0e0e0; border-radius: 8px;">
    </div>
    <div id="searchResults"></div>
</div>

<div id="addForm" style="display:none;" class="content-box">
    <h2>Add New Product</h2>
    <form method="post" action="../controllers/addShopProduct.php" class="form-style">
        <div class="form-row">
            <div class="form-group">
                <label>Product Name *</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Fertilizer">Fertilizer</option>
                    <option value="Seeds">Seeds</option>
                    <option value="Pesticides">Pesticides</option>
                    <option value="Tools">Tools</option>
                    <option value="Equipment">Equipment</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Price (৳) *</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            <div class="form-group">
                <label>Stock Quantity *</label>
                <input type="number" name="stock" required>
            </div>
        </div>
        
        <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" name="supplier">
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Add Product</button>
            <button type="button" onclick="toggleForm('addForm')" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<div class="content-box">
    <div class="table-responsive" id="productsTable">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><span class="badge"><?php echo $product['category']; ?></span></td>
                        <td>৳<?php echo number_format($product['price'], 2); ?></td>
                        <td><?php echo $product['stock']; ?></td>
                        <td><?php echo htmlspecialchars($product['supplier_name']); ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn-small">Edit</a>
                            <a href="../controllers/deleteShopProduct.php?id=<?php echo $product['id']; ?>" 
                               class="btn-small btn-danger" 
                               onclick="return confirm('Delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
