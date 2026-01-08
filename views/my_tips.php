<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'expert'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/tipModel.php');
$myTips = getTipsByExpert($_SESSION['user_id']);

$pageTitle = "My Expert Tips";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'added') echo 'Tip posted successfully!';
            elseif($_GET['success'] == 'updated') echo 'Tip updated successfully!';
            elseif($_GET['success'] == 'deleted') echo 'Tip deleted successfully!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <div class="box-header">
        <h2>My Tips (<?php echo count($myTips); ?>)</h2>
        <a href="post_tip.php" class="btn">Post New Tip</a>
    </div>
</div>

<?php if(count($myTips) > 0): ?>
    <div class="content-box">
        <div class="tips-list">
            <?php foreach($myTips as $tip): ?>
                <div class="tip-card">
                    <div class="tip-header">
                        <h3><?php echo htmlspecialchars($tip['title']); ?></h3>
                        <span class="badge"><?php echo $tip['category']; ?></span>
                    </div>
                    
                    <div class="tip-content">
                        <?php echo nl2br(htmlspecialchars($tip['content'])); ?>
                    </div>
                    
                    <div class="tip-footer">
                        <span>Posted: <?php echo date('M d, Y', strtotime($tip['created_at'])); ?></span>
                        <div>
                            <a href="edit_tip.php?id=<?php echo $tip['id']; ?>" class="btn-small">Edit</a>
                            <a href="../controllers/deleteTip.php?id=<?php echo $tip['id']; ?>" 
                               class="btn-small btn-danger" 
                               onclick="return confirm('Delete this tip?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <p>You haven't posted any tips yet. <a href="post_tip.php">Post your first tip!</a></p>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
