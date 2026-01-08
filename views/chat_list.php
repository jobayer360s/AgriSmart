<?php
require_once('../controllers/authCheck.php');
require_once(__DIR__ . '/../models/messageModel.php');

$conversations = getConversations($_SESSION['user_id']);

$pageTitle = "Messages";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>My Conversations</h2>
</div>

<?php if(count($conversations) > 0): ?>
    <div class="content-box">
        <div class="contacts-list">
            <?php foreach($conversations as $conv): ?>
                <a href="chat.php?user=<?php echo $conv['contact_id']; ?>" class="contact-card">
                    <div class="contact-avatar">
                        <?php echo strtoupper(substr($conv['username'], 0, 1)); ?>
                    </div>
                    <div class="contact-info">
                        <h3><?php echo htmlspecialchars($conv['username']); ?></h3>
                        <p style="color: #999; font-size: 0.9em;">
                            <span class="badge badge-<?php echo $conv['role']; ?>"><?php echo ucfirst($conv['role']); ?></span>
                        </p>
                        <p style="color: #666; font-size: 0.9em; margin-top: 5px;">
                            <?php echo htmlspecialchars(substr($conv['last_message'], 0, 50)) . (strlen($conv['last_message']) > 50 ? '...' : ''); ?>
                        </p>
                    </div>
                    <div class="contact-arrow">→</div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 4em;">💬</div>
            <h2>No conversations yet</h2>
            <p>Start chatting with experts or farmers</p>
            <?php if($_SESSION['role'] == 'farmer'): ?>
                <a href="experts_list.php" class="btn">Find Experts</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
