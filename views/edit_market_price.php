<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/marketModel.php');

if(!isset($_GET['id'])){
    header('location: manage_market_prices.php');
    exit;
}

$price = getMarketPriceById($_GET['id']);

if(!$price){
    header('location: manage_market_prices.php?error=not_found');
    exit;
}

$pageTitle = "Edit Market Price";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Edit Market Price</h2>
    
    <form method="post" action="../controllers/updateMarketPrice.php" class="form-style">
        <input type="hidden" name="id" value="<?php echo $price['id']; ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Crop Name *</label>
                <input type="text" name="crop_name" value="<?php echo htmlspecialchars($price['crop_name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Price (৳ per kg) *</label>
                <input type="number" step="0.01" name="price" value="<?php echo $price['price']; ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Location *</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($price['location']); ?>" required>
            </div>
            <div class="form-group">
                <label>Date *</label>
                <input type="date" name="date" value="<?php echo $price['date']; ?>" required>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update Price</button>
            <a href="manage_market_prices.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
