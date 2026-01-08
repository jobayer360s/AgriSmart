<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/userModel.php');
$users = getAllUsers();

$pageTitle = "Manage Users";
include('../assets/includes/header.php');
?>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php 
            if($_GET['success'] == 'added') echo 'User added successfully!';
            elseif($_GET['success'] == 'updated') echo 'User updated successfully!';
            elseif($_GET['success'] == 'deleted') echo 'User deleted successfully!';
        ?>
    </div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert alert-error">
        <?php 
            if($_GET['error'] == 'exists') echo 'Username or email already exists!';
            elseif($_GET['error'] == 'cannot_delete_self') echo 'You cannot delete yourself!';
            elseif($_GET['error'] == 'permission_denied') echo 'You do not have permission to perform this action!';
            else echo 'Action failed!';
        ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <div class="box-header">
        <h2>All Users (<?php echo count($users); ?>)</h2>
        <button onclick="toggleForm('addUserForm')" class="btn">Add New User</button>
    </div>
    
    <!-- Search with AJAX -->
    <div style="margin: 20px 0;">
        <input type="text" id="searchUser" placeholder="Search users by username, email, or role..." style="padding: 10px; width: 100%; max-width: 500px; border: 2px solid #e0e0e0; border-radius: 8px;">
    </div>
    <div id="searchResults"></div>
</div>

<div id="addUserForm" style="display:none;" class="content-box">
    <h2>Add New User</h2>
    <form method="post" action="../controllers/addUser.php" class="form-style">
        <div class="form-row">
            <div class="form-group">
                <label>Username *</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label>Password *</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Role *</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="farmer">Farmer</option>
                    <option value="expert">Expert</option>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <option value="management">Management</option>
                        <option value="admin">Admin</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="submit" class="btn">Add User</button>
            <button type="button" onclick="toggleForm('addUserForm')" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<div class="content-box">
    <div class="table-responsive" id="usersTable">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><span class="badge badge-<?php echo $user['role']; ?>"><?php echo ucfirst($user['role']); ?></span></td>
                        <td><span class="status-<?php echo $user['status']; ?>"><?php echo ucfirst($user['status']); ?></span></td>
                        <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                        <td>
                            <?php
                            // Admin can edit everyone
                            // Management can edit everyone EXCEPT admin
                            $canEdit = false;
                            $canDelete = false;
                            
                            if($_SESSION['role'] == 'admin') {
                                $canEdit = true;
                                $canDelete = ($user['id'] != $_SESSION['user_id']); // Admin cannot delete self
                            } elseif($_SESSION['role'] == 'management') {
                                if($user['role'] != 'admin') {
                                    $canEdit = true;
                                    $canDelete = ($user['id'] != $_SESSION['user_id']); // Management cannot delete self
                                }
                            }
                            ?>
                            
                            <?php if($canEdit): ?>
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-small">Edit</a>
                            <?php else: ?>
                                <span style="color: #999; font-size: 0.9em;">No Access</span>
                            <?php endif; ?>
                            
                            <?php if($canDelete): ?>
                                <a href="../controllers/deleteUser.php?id=<?php echo $user['id']; ?>" 
                                   class="btn btn-small btn-danger" 
                                   onclick="return confirm('Delete this user?')">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
