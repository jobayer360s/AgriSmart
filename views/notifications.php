<?php
require_once('authCheck.php');
require_once(__DIR__ . '/../models/notificationModel.php');

$notifications = getNotifications($_SESSION['user_id']);

$pageTitle = "Notifications";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <div class="box-header">
        <h2>My Notifications (<?php echo count($notifications); ?>)</h2>
        <a href="../controllers/markAllNotificationsRead.php" class="btn btn-secondary">Mark All as Read</a>
    </div>
</div>

<?php if(count($notifications) > 0): ?>
    <div class="content-box">
        <div class="notifications-list">
            <?php foreach($notifications as $notif): ?>
                <div class="notification-card <?php echo $notif['is_read'] ? 'notification-read' : 'notification-unread'; ?>">
                    <div class="notification-icon">
                        <?php 
                            $icons = [
                                'order' => '🛒',
                                'tip' => '💡',
                                'answer' => '✅',
                                'message' => '💬',
                                'task' => '📅',
                                'ticket' => '🎫',
                                'system' => 'ℹ️'
                            ];
                            echo $icons[$notif['type']] ?? 'ℹ️';
                        ?>
                    </div>
                    <div class="notification-content">
                        <h3><?php echo htmlspecialchars($notif['title']); ?></h3>
                        <p><?php echo htmlspecialchars($notif['message']); ?></p>
                        <div class="notification-footer">
                            <span><?php echo date('M d, Y h:i A', strtotime($notif['created_at'])); ?></span>
                            <?php if($notif['link']): ?>
                                <a href="<?php echo $notif['link']; ?>" class="btn-small">View</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 4em;">🔔</div>
            <h2>No notifications</h2>
            <p>You're all caught up!</p>
        </div>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
