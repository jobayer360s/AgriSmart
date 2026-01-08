<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'expert'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/tipModel.php');

if(!isset($_GET['id'])){
    header('location: my_tips.php');
    exit;
}

$tip = getTipById($_GET['id']);

if(!$tip || $tip['expert_id'] != $_SESSION['user_id']){
    header('location: my_tips.php?error=not_found');
    exit;
}

$pageTitle = "Edit Tip";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Edit Tip</h2>
    
    <form method="post" action="../controllers/updateTip.php" class="form-style">
        <input type="hidden" name="id" value="<?php echo $tip['id']; ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Tip Title *</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($tip['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="Rice" <?php echo $tip['category']=='Rice'?'selected':''; ?>>Rice</option>
                    <option value="Vegetables" <?php echo $tip['category']=='Vegetables'?'selected':''; ?>>Vegetables</option>
                    <option value="Pest Control" <?php echo $tip['category']=='Pest Control'?'selected':''; ?>>Pest Control</option>
                    <option value="Fertilizer" <?php echo $tip['category']=='Fertilizer'?'selected':''; ?>>Fertilizer</option>
                    <option value="Irrigation" <?php echo $tip['category']=='Irrigation'?'selected':''; ?>>Irrigation</option>
                    <option value="General" <?php echo $tip['category']=='General'?'selected':''; ?>>General</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>Tip Content *</label>
            <textarea name="content" rows="10" required><?php echo htmlspecialchars($tip['content']); ?></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update Tip</button>
            <a href="my_tips.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
