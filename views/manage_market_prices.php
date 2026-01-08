<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/marketModel.php');
$prices = getAllMarketPrices();

$pageTitle = "Manage Market Prices";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'added') echo 'Market price added successfully!';
            elseif($_GET['success'] == 'updated') echo 'Market price updated successfully!';
            elseif($_GET['success'] == 'deleted') echo 'Market price deleted successfully!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <div class="box-header">
        <h2>Market Prices Management</h2>
        <button onclick="toggleForm('addPriceForm')" class="btn">Add New Price</button>
    </div>
</div>

<div id="addPriceForm" style="display:none;" class="content-box">
    <h2>Add Market Price</h2>
    <form method="post" action="../controllers/addMarketPrice.php" class="form-style">
        <div class="form-row">
            <div class="form-group">
                <label>Crop Name *</label>
                <input type="text" name="crop_name" required>
            </div>
            <div class="form-group">
                <label>Price (৳) *</label>
                <input type="number" step="0.01" name="price" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Unit *</label>
                <select name="unit" required>
                    <option value="kg">Per KG</option>
                    <option value="quintal">Per Quintal</option>
                    <option value="ton">Per Ton</option>
                </select>
            </div>
            <div class="form-group">
                <label>Region *</label>
                <input type="text" name="region" value="Dhaka" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Source *</label>
                <input type="text" name="source" placeholder="e.g., DAM" required>
            </div>
            <div class="form-group">
                <label>Price Date *</label>
                <input type="date" name="price_date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Add Price</button>
            <button type="button" onclick="toggleForm('addPriceForm')" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<div class="content-box">
    <h2>All Market Prices (<?php echo count($prices); ?>)</h2>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Crop</th>
                    <th>Price</th>
                    <th>Unit</th>
                    <th>Region</th>
                    <th>Source</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($prices as $price): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($price['crop_name']); ?></strong></td>
                        <td style="color: #28a745; font-weight: 600;">৳<?php echo number_format($price['price'], 2); ?></td>
                        <td><?php echo $price['unit']; ?></td>
                        <td><?php echo htmlspecialchars($price['region']); ?></td>
                        <td><?php echo htmlspecialchars($price['source']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($price['price_date'])); ?></td>
                        <td>
                            <a href="edit_market_price.php?id=<?php echo $price['id']; ?>" class="btn-small">Edit</a>
                            <a href="../controllers/deleteMarketPrice.php?id=<?php echo $price['id']; ?>" 
                               class="btn-small btn-danger" 
                               onclick="return confirm('Delete this price?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
