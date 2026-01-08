<?php
require_once('../controllers/authCheck.php');
require_once(__DIR__ . '/../models/userModel.php');

$user = getUserById($_SESSION['user_id']);

$pageTitle = "My Profile";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>My Profile</h2>
    <div class="profile-container">
        <div class="profile-avatar-large">
            <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
        </div>
        
        <div class="profile-info">
            <table class="info-table">
                <tr>
                    <td><strong>Username:</strong></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
                <tr>
                    <td><strong>Role:</strong></td>
                    <td><span class="badge badge-<?php echo $user['role']; ?>"><?php echo ucfirst($user['role']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Status:</strong></td>
                    <td><span class="badge status-<?php echo $user['status']; ?>"><?php echo ucfirst($user['status']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Member Since:</strong></td>
                    <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                </tr>
            </table>
            
            <div style="margin-top: 20px;">
                <a href="edit_profile.php" class="btn">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<?php include('../assets/includes/footer.php'); ?>
