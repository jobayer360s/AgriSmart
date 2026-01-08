<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'expert'){
    header('location: login.php');
    exit;
}

$pageTitle = "Post Expert Tip";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Post New Expert Tip</h2>
    <p>Share your agricultural knowledge with farmers</p>
    
    <form method="post" action="../controllers/addTip.php" class="form-style">
        <div class="form-row">
            <div class="form-group">
                <label>Tip Title *</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Rice">Rice</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="Pest Control">Pest Control</option>
                    <option value="Fertilizer">Fertilizer</option>
                    <option value="Irrigation">Irrigation</option>
                    <option value="General">General</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>Tip Content *</label>
            <textarea name="content" rows="10" placeholder="Share detailed advice and tips..." required></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Post Tip</button>
            <a href="my_tips.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
