<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'expert'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/tipModel.php');
require_once(__DIR__ . '/../models/questionModel.php');
require_once(__DIR__ . '/../models/messageModel.php');

$myTips = getTipsByExpert($_SESSION['user_id']);
$questions = getAllQuestions();
$openQuestions = array_filter($questions, function($q) { return $q['status'] == 'open'; });
$conversations = getConversations($_SESSION['user_id']);

$pageTitle = "Expert Dashboard";
include('../assets/includes/header.php');
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">💡</div>
        <div class="stat-content">
            <h3><?php echo count($myTips); ?></h3>
            <p>My Tips Posted</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">❓</div>
        <div class="stat-content">
            <h3><?php echo count($openQuestions); ?></h3>
            <p>Open Questions</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">💬</div>
        <div class="stat-content">
            <h3><?php echo count($conversations); ?></h3>
            <p>Active Chats</p>
        </div>
    </div>
</div>

<div class="content-box">
    <h2>Quick Actions</h2>
    <div class="action-grid">
        <a href="my_tips.php" class="action-btn">💡 My Tips</a>
        <a href="post_tip.php" class="action-btn">➕ Post New Tip</a>
        <a href="questions.php" class="action-btn">❓ Answer Questions</a>
        <a href="chat_list.php" class="action-btn">💬 Messages</a>
    </div>
</div>

<div class="content-box">
    <h2>Recent Open Questions</h2>
    <?php if(count($openQuestions) > 0): ?>
        <div class="questions-list">
            <?php foreach(array_slice($openQuestions, 0, 3) as $question): ?>
                <div class="question-card">
                    <div class="question-header">
                        <h3><?php echo htmlspecialchars($question['title']); ?></h3>
                        <span class="badge status-open">Open</span>
                    </div>
                    <div class="question-content">
                        <?php echo nl2br(htmlspecialchars(substr($question['content'], 0, 150))); ?>...
                    </div>
                    <div class="question-footer">
                        <span>By: <?php echo htmlspecialchars($question['farmer_name']); ?></span>
                        <a href="view_question.php?id=<?php echo $question['id']; ?>" class="btn-small">Answer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="questions.php" class="btn" style="margin-top: 20px;">View All Questions</a>
    <?php else: ?>
        <p>No open questions at the moment.</p>
    <?php endif; ?>
</div>

<?php include('../assets/includes/footer.php'); ?>
