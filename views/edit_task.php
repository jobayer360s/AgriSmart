<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

if(!isset($_GET['id'])){
    header('location: calendar.php');
    exit;
}

$stmt = $GLOBALS['conn']->prepare("SELECT * FROM tasks WHERE id = ? AND farmer_id = ?");
$stmt->execute([$_GET['id'], $_SESSION['user_id']]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$task){
    header('location: calendar.php?error=not_found');
    exit;
}

$pageTitle = "Edit Task";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Edit Task</h2>
    
    <form method="post" action="../controllers/updateTask.php" class="form-style">
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Task Title *</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Task Type *</label>
                <select name="task_type" required>
                    <option value="Planting" <?php echo $task['task_type']=='Planting'?'selected':''; ?>>Planting</option>
                    <option value="Fertilizing" <?php echo $task['task_type']=='Fertilizing'?'selected':''; ?>>Fertilizing</option>
                    <option value="Watering" <?php echo $task['task_type']=='Watering'?'selected':''; ?>>Watering</option>
                    <option value="Harvesting" <?php echo $task['task_type']=='Harvesting'?'selected':''; ?>>Harvesting</option>
                    <option value="Pest Control" <?php echo $task['task_type']=='Pest Control'?'selected':''; ?>>Pest Control</option>
                    <option value="Other" <?php echo $task['task_type']=='Other'?'selected':''; ?>>Other</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Task Date *</label>
            <input type="date" name="task_date" value="<?php echo $task['task_date']; ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update Task</button>
            <a href="calendar.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
