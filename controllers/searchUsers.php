<?php
require_once(__DIR__ . '/../models/userModel.php');

if(isset($_POST['query'])) {
    $query = trim($_POST['query']);
    
    if(empty($query)) {
        echo '';
        exit;
    }
    
    $users = getAllUsers();
    $filtered = array_filter($users, function($user) use ($query) {
        return stripos($user['username'], $query) !== false || 
               stripos($user['email'], $query) !== false ||
               stripos($user['role'], $query) !== false;
    });
    
    if(count($filtered) > 0) {
        echo '<table class="data-table">';
        echo '<thead><tr><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Action</th></tr></thead>';
        echo '<tbody>';
        foreach($filtered as $user) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($user['username']) . '</td>';
            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
            echo '<td><span class="badge badge-' . $user['role'] . '">' . ucfirst($user['role']) . '</span></td>';
            echo '<td><span class="status-' . $user['status'] . '">' . ucfirst($user['status']) . '</span></td>';
            echo '<td><a href="edit_user.php?id=' . $user['id'] . '" class="btn-small">Edit</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No users found.</p>';
    }
}
?>
