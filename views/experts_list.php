<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/userModel.php');
$experts = getUsersByRole('expert');

$pageTitle = "Chat with Experts";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Available Experts</h2>
    <p>Connect with agricultural experts for advice and guidance</p>
</div>

<div class="content-box">
    <div class="contacts-list">
        <?php foreach($experts as $expert): ?>
            <a href="chat.php?user=<?php echo $expert['id']; ?>" class="contact-card">
                <div class="contact-avatar">
                    <?php echo strtoupper(substr($expert['username'], 0, 1)); ?>
                </div>
                <div class="contact-info">
                    <h3><?php echo htmlspecialchars($expert['username']); ?></h3>
                    <p style="color: #666;">
                        <span class="badge badge-expert">Expert</span>
                    </p>
                </div>
                <div class="contact-arrow">💬</div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
