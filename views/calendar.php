<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'farmer'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/taskModel.php');
$tasks = getTasksByFarmer($_SESSION['user_id']);

$pageTitle = "My Farming Calendar";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'added') echo 'Task added successfully!';
            elseif($_GET['success'] == 'updated') echo 'Task updated successfully!';
            elseif($_GET['success'] == 'completed') echo 'Task marked as complete!';
            elseif($_GET['success'] == 'deleted') echo 'Task deleted successfully!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <div class="box-header">
        <h2>My Farming Tasks</h2>
        <button onclick="toggleForm('addTaskForm')" class="btn">Add New Task</button>
    </div>
</div>

<div id="addTaskForm" style="display:none;" class="content-box">
    <h2>Add New Task</h2>
    <form method="post" action="../controllers/addTask.php" class="form-style">
        <div class="form-row">
            <div class="form-group">
                <label>Task Title *</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Task Type *</label>
                <select name="task_type" required>
                    <option value="">Select Type</option>
                    <option value="Planting">Planting</option>
                    <option value="Fertilizing">Fertilizing</option>
                    <option value="Watering">Watering</option>
                    <option value="Harvesting">Harvesting</option>
                    <option value="Pest Control">Pest Control</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label>Task Date *</label>
            <input type="date" name="task_date" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Add Task</button>
            <button type="button" onclick="toggleForm('addTaskForm')" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<div class="content-box">
    <h2>All Tasks (<?php echo count($tasks); ?>)</h2>
    
    <?php if(count($tasks) > 0): ?>
        <div class="tasks-list">
            <?php foreach($tasks as $task): ?>
                <div class="task-card <?php echo $task['completed'] ? 'task-completed' : ''; ?>">
                    <div class="task-header">
                        <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                        <span class="badge"><?php echo $task['task_type']; ?></span>
                    </div>
                    
                    <?php if($task['description']): ?>
                        <p><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
                    <?php endif; ?>
                    
                    <div class="task-footer">
                        <span>📅 <?php echo date('M d, Y', strtotime($task['task_date'])); ?></span>
                        <div class="task-actions">
                            <?php if(!$task['completed']): ?>
                                <a href="../controllers/markTaskComplete.php?id=<?php echo $task['id']; ?>" class="btn-small" onclick="return confirm('Mark as complete?')">✓ Complete</a>
                                <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn-small">Edit</a>
                            <?php endif; ?>
                            <a href="../controllers/deleteTask.php?id=<?php echo $task['id']; ?>" class="btn-small btn-danger" onclick="return confirm('Delete this task?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No tasks scheduled. Add a task to get started.</p>
    <?php endif; ?>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
