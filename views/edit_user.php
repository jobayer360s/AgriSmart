<?php
require_once('authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/userModel.php');

$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user = getUserById($userId);

if(!$user) {
    header('location: manage_users.php?error=not_found');
    exit;
}

// ============================================
// PERMISSION CHECK: Management cannot edit Admin users
// ============================================
if($_SESSION['role'] == 'management' && $user['role'] == 'admin') {
    header('location: manage_users.php?error=permission_denied');
    exit;
}

$pageTitle = "Edit User";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <div class="box-header">
        <h2>Edit User: <?php echo htmlspecialchars($user['username']); ?></h2>
        <a href="manage_users.php" class="btn btn-secondary">Back to Users</a>
    </div>
    
    <form method="post" action="../controllers/updateUser.php" class="form-style">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Username *</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Role *</label>
                <select name="role" required>
                    <option value="farmer" <?php echo ($user['role'] == 'farmer') ? 'selected' : ''; ?>>Farmer</option>
                    <option value="expert" <?php echo ($user['role'] == 'expert') ? 'selected' : ''; ?>>Expert</option>
                    <option value="management" <?php echo ($user['role'] == 'management') ? 'selected' : ''; ?>>Management</option>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status *</label>
                <select name="status" required>
                    <option value="active" <?php echo ($user['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                    <option value="suspended" <?php echo ($user['status'] == 'suspended') ? 'selected' : ''; ?>>Suspended</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password" placeholder="Enter new password">
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Update User</button>
            <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include('../assets/includes/footer.php'); ?>
