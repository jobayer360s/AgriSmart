<?php
require_once('authCheck.php');
require_once(__DIR__ . '/../models/questionModel.php');

$questions = getAllQuestions();

$pageTitle = "Q&A Board";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <div class="box-header">
        <h2>Questions & Answers (<?php echo count($questions); ?>)</h2>
        <?php if($_SESSION['role'] == 'farmer'): ?>
            <a href="ask_question.php" class="btn">Ask a Question</a>
        <?php endif; ?>
    </div>
</div>

<?php if(count($questions) > 0): ?>
    <div class="content-box">
        <div class="questions-list">
            <?php foreach($questions as $question): ?>
                <div class="question-card">
                    <div class="question-header">
                        <h3><?php echo htmlspecialchars($question['title']); ?></h3>
                        <span class="badge status-<?php echo $question['status']; ?>">
                            <?php echo ucfirst($question['status']); ?>
                        </span>
                    </div>
                    
                    <div class="question-content">
                        <?php echo nl2br(htmlspecialchars(substr($question['content'], 0, 200))); ?>
                        <?php if(strlen($question['content']) > 200): ?>...<?php endif; ?>
                    </div>
                    
                    <div class="question-footer">
                        <span>Asked by: <strong><?php echo htmlspecialchars($question['farmer_name']); ?></strong></span>
                        <span>📅 <?php echo date('M d, Y', strtotime($question['created_at'])); ?></span>
                        <span>💬 <?php echo $question['answer_count']; ?> answers</span>
                        <a href="view_question.php?id=<?php echo $question['id']; ?>" class="btn-small">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="content-box">
        <p>No questions yet. Be the first to ask!</p>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
