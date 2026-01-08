<?php
require_once('authCheck.php');
require_once(__DIR__ . '/../models/userModel.php');

$user = getUserById($_SESSION['user_id']);

$pageTitle = "Edit Profile";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'password_changed') echo 'Password changed successfully!';
            elseif($_GET['success'] == 'updated') echo 'Profile updated successfully!';
        ?>
    </div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert alert-error">
        <?php 
            if($_GET['error'] == 'mismatch') echo 'Passwords do not match!';
            elseif($_GET['error'] == 'wrong_password') echo 'Current password is incorrect!';
            elseif($_GET['error'] == 'failed') echo 'Update failed!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <h2>Edit Profile</h2>
    
    <form method="post" action="../controllers/updateProfile.php" class="form-style">
        <div class="form-group">
            <label>Username *</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update Profile</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<div class="content-box">
    <h2>Change Password</h2>
    
    <form method="post" action="../controllers/changePassword.php" class="form-style">
        <div class="form-group">
            <label>Current Password *</label>
            <input type="password" name="current_password" required>
        </div>
        
        <div class="form-group">
            <label>New Password *</label>
            <input type="password" name="new_password" required>
        </div>
        
        <div class="form-group">
            <label>Confirm New Password *</label>
            <input type="password" name="confirm_password" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Change Password</button>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
