<?php
require_once('authCheck.php');
require_once(__DIR__ . '/../models/tipModel.php');

$tips = getAllTips();

$pageTitle = "Expert Tips";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Expert Agricultural Tips (<?php echo count($tips); ?>)</h2>
    <p>Browse farming tips and advice from agricultural experts</p>
</div>

<div class="content-box">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search tips..." onkeyup="searchTipsLive()">
    </div>
    <div id="searchResults"></div>
</div>

<?php if(count($tips) > 0): ?>
    <div class="content-box">
        <div class="tips-list" id="tipsList">
            <?php foreach($tips as $tip): ?>
                <div class="tip-card">
                    <div class="tip-header">
                        <h3><?php echo htmlspecialchars($tip['title']); ?></h3>
                        <span class="badge"><?php echo $tip['category']; ?></span>
                    </div>
                    
                    <div class="tip-content">
                        <?php echo nl2br(htmlspecialchars($tip['content'])); ?>
                    </div>
                    
                    <div class="tip-footer">
                        <span>By: <strong><?php echo htmlspecialchars($tip['expert_name']); ?></strong></span>
                        <span>📅 <?php echo date('M d, Y', strtotime($tip['created_at'])); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <p>No tips available yet.</p>
    </div>
<?php endif; ?>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
