<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/orderModel.php');
require_once(__DIR__ . '/../models/taskModel.php');
require_once(__DIR__ . '/../models/tipModel.php');

$myOrders = getOrdersByFarmer($_SESSION['user_id']);
$upcomingTasks = getUpcomingTasks($_SESSION['user_id'], 7);
$recentTips = array_slice(getAllTips(), 0, 3);

$pageTitle = "Farmer Dashboard";
include('../assets/includes/header.php');
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🛒</div>
        <div class="stat-content">
            <h3><?php echo count($myOrders); ?></h3>
            <p>My Orders</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-content">
            <h3><?php echo count($upcomingTasks); ?></h3>
            <p>Upcoming Tasks</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">💡</div>
        <div class="stat-content">
            <h3><?php echo count(getAllTips()); ?></h3>
            <p>Expert Tips</p>
        </div>
    </div>
</div>

<div class="content-box">
    <h2>Quick Actions</h2>
    <div class="action-grid">
        <a href="shop.php" class="action-btn">🛍️ Shop Products</a>
        <a href="my_orders.php" class="action-btn">📦 My Orders</a>
        <a href="cart.php" class="action-btn">🛒 Shopping Cart</a>
        <a href="calendar.php" class="action-btn">📅 My Calendar</a>
        <a href="all_tips.php" class="action-btn">💡 Expert Tips</a>
        <a href="questions.php" class="action-btn">❓ Q&A Board</a>
        <a href="chat_list.php" class="action-btn">💬 Chat</a>
        <a href="weather.php" class="action-btn">🌤️ Weather</a>
    </div>
</div>

<div class="content-box">
    <h2>Upcoming Tasks (Next 7 Days)</h2>
    <?php if(count($upcomingTasks) > 0): ?>
        <div class="tasks-list">
            <?php foreach($upcomingTasks as $task): ?>
                <div class="task-card">
                    <div class="task-header">
                        <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                        <span class="badge"><?php echo $task['task_type']; ?></span>
                    </div>
                    <p><?php echo htmlspecialchars($task['description']); ?></p>
                    <div class="task-footer">
                        <span>📅 <?php echo date('M d, Y', strtotime($task['task_date'])); ?></span>
                        <a href="calendar.php" class="btn-small">View All Tasks</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No upcoming tasks. <a href="calendar.php">Add a task</a></p>
    <?php endif; ?>
</div>

<div class="content-box">
    <h2>Recent Expert Tips</h2>
    <div class="tips-list">
        <?php foreach($recentTips as $tip): ?>
            <div class="tip-card">
                <div class="tip-header">
                    <h3><?php echo htmlspecialchars($tip['title']); ?></h3>
                    <span class="badge"><?php echo $tip['category']; ?></span>
                </div>
                <div class="tip-content">
                    <?php echo htmlspecialchars(substr($tip['content'], 0, 150)); ?>...
                </div>
                <div class="tip-footer">
                    <span>By: <strong><?php echo htmlspecialchars($tip['expert_name']); ?></strong></span>
                    <a href="all_tips.php" class="btn-small">View All Tips</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
