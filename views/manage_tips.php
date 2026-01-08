<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/tipModel.php');
$tips = getAllTips();

$pageTitle = "Manage Expert Tips";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Tip deleted successfully!</div>
<?php endif; ?>

<div class="content-box">
    <h2>All Expert Tips (<?php echo count($tips); ?>)</h2>
    
    <!-- Search with AJAX -->
    <div style="margin: 20px 0;">
        <input type="text" id="searchTip" placeholder="Search tips by title, content, or expert..." style="padding: 10px; width: 100%; max-width: 500px; border: 2px solid #e0e0e0; border-radius: 8px;">
    </div>
    <div id="searchResults"></div>
</div>

<div class="content-box" id="tipsTable">
    <div class="tips-list">
        <?php foreach($tips as $tip): ?>
            <div class="tip-card">
                <div class="tip-header">
                    <h3><?php echo htmlspecialchars($tip['title']); ?></h3>
                    <span class="badge"><?php echo htmlspecialchars($tip['category']); ?></span>
                </div>
                <div class="tip-content">
                    <?php echo htmlspecialchars(substr($tip['content'], 0, 200)); ?>...
                </div>
                <div class="tip-footer">
                    <span>By: <strong><?php echo htmlspecialchars($tip['expert_name']); ?></strong></span>
                    <span>Posted: <?php echo date('M d, Y', strtotime($tip['created_at'])); ?></span>
                    <a href="../controllers/deleteTip.php?id=<?php echo $tip['id']; ?>" 
                       class="btn-small btn-danger" 
                       onclick="return confirm('Delete this tip?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
