<?php
require_once('../controllers/authCheck.php');
require_once(__DIR__ . '/../models/questionModel.php');

if(!isset($_GET['id'])){
    header('location: questions.php');
    exit;
}

$question = getQuestionById($_GET['id']);
$answers = getAnswers($_GET['id']);

if(!$question){
    header('location: questions.php?error=not_found');
    exit;
}

$pageTitle = "Question Details";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Answer submitted successfully!</div>
<?php endif; ?>

<div class="content-box">
    <a href="questions.php" class="btn btn-secondary" style="margin-bottom: 20px;">← Back to Questions</a>
    
    <div class="question-card" style="border: 2px solid #667eea;">
        <div class="question-header">
            <h2><?php echo htmlspecialchars($question['title']); ?></h2>
            <span class="badge status-<?php echo $question['status']; ?>">
                <?php echo ucfirst($question['status']); ?>
            </span>
        </div>
        
        <div class="question-content">
            <?php echo nl2br(htmlspecialchars($question['content'])); ?>
        </div>
        
        <div class="question-footer">
            <span>Asked by: <strong><?php echo htmlspecialchars($question['farmer_name']); ?></strong></span>
            <span>📅 <?php echo date('M d, Y h:i A', strtotime($question['created_at'])); ?></span>
        </div>
    </div>
</div>

<div class="content-box">
    <h3>Answers (<?php echo count($answers); ?>)</h3>
    
    <?php if(count($answers) > 0): ?>
        <div style="margin-top: 20px;">
            <?php foreach($answers as $answer): ?>
                <div class="tip-card" style="margin-bottom: 20px; border-left-color: #28a745;">
                    <div class="tip-header">
                        <div>
                            <strong><?php echo htmlspecialchars($answer['expert_name']); ?></strong>
                            <span class="badge badge-expert">Expert</span>
                        </div>
                        <span style="color: #999; font-size: 0.9em;">
                            <?php echo date('M d, Y h:i A', strtotime($answer['created_at'])); ?>
                        </span>
                    </div>
                    <div class="tip-content">
                        <?php echo nl2br(htmlspecialchars($answer['content'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No answers yet. Be the first to answer!</p>
    <?php endif; ?>
</div>

<?php if($_SESSION['role'] == 'expert'): ?>
    <div class="content-box">
        <h3>Your Answer</h3>
        <form method="post" action="../controllers/addAnswer.php" class="form-style">
            <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
            
            <div class="form-group">
                <label>Answer *</label>
                <textarea name="content" rows="6" placeholder="Provide a helpful answer..." required></textarea>
            </div>
            
            <button type="submit" name="submit" class="btn">Submit Answer</button>
        </form>
    </div>
<?php endif; ?>

<?php include('../assets/includes/footer.php'); ?>
