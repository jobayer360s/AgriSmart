<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

$pageTitle = "Ask a Question";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Ask a Question</h2>
    <p>Get expert advice on your farming questions</p>
    
    <form method="post" action="../controllers/addQuestion.php" class="form-style">
        <div class="form-group">
            <label>Question Title *</label>
            <input type="text" name="title" placeholder="Brief summary of your question" required>
        </div>
        
        <div class="form-group">
            <label>Question Details *</label>
            <textarea name="content" rows="8" placeholder="Describe your question in detail..." required></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Submit Question</button>
            <a href="questions.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
