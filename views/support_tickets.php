<?php
require_once('../controllers/authCheck.php');

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'management'){
    header('location: login.php');
    exit;
}

require_once(__DIR__ . '/../models/supportModel.php');
$tickets = getAllSupportTickets();

$pageTitle = "Support Tickets";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>All Support Tickets (<?php echo count($tickets); ?>)</h2>
</div>

<div class="content-box">
    <?php foreach($tickets as $ticket): ?>
        <div class="tip-card" style="border-left-color: <?php echo $ticket['priority']=='high'?'#dc3545':($ticket['priority']=='medium'?'#ffc107':'#28a745'); ?>">
            <div class="tip-header">
                <div>
                    <h3><?php echo htmlspecialchars($ticket['subject']); ?></h3>
                    <p style="margin: 5px 0; color: #666;">
                        By: <strong><?php echo htmlspecialchars($ticket['username']); ?></strong> 
                        (<?php echo ucfirst($ticket['role']); ?>)
                        | Priority: <span class="badge"><?php echo ucfirst($ticket['priority']); ?></span>
                        | Status: <span class="status-<?php echo $ticket['status']; ?>"><?php echo ucfirst(str_replace('_', ' ', $ticket['status'])); ?></span>
                    </p>
                </div>
            </div>
            
            <div class="tip-content">
                <p><strong>Message:</strong></p>
                <p><?php echo nl2br(htmlspecialchars($ticket['message'])); ?></p>
                
                <?php if($ticket['admin_response']): ?>
                    <p style="margin-top: 15px;"><strong>Admin Response:</strong></p>
                    <p style="background: #f8f9fa; padding: 10px; border-radius: 8px;">
                        <?php echo nl2br(htmlspecialchars($ticket['admin_response'])); ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #e0e0e0;">
                <div class="form-style">
                    <div class="form-group">
                        <label>Update Status:</label>
                        <select id="ticketStatus_<?php echo $ticket['id']; ?>">
                            <option value="open" <?php echo $ticket['status']=='open'?'selected':''; ?>>Open</option>
                            <option value="in_progress" <?php echo $ticket['status']=='in_progress'?'selected':''; ?>>In Progress</option>
                            <option value="resolved" <?php echo $ticket['status']=='resolved'?'selected':''; ?>>Resolved</option>
                            <option value="closed" <?php echo $ticket['status']=='closed'?'selected':''; ?>>Closed</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Admin Response:</label>
                        <textarea id="adminResponse_<?php echo $ticket['id']; ?>" rows="3" placeholder="Enter response..."><?php echo htmlspecialchars($ticket['admin_response']); ?></textarea>
                    </div>
                    
                    <button onclick="updateTicketStatus(<?php echo $ticket['id']; ?>)" class="btn">Update Ticket</button>
                    <div id="statusDisplay_<?php echo $ticket['id']; ?>" style="margin-top: 10px; font-weight: 600;"></div>
                </div>
            </div>
            
            <div class="tip-footer">
                <span>Created: <?php echo date('M d, Y h:i A', strtotime($ticket['created_at'])); ?></span>
                <span>Updated: <?php echo date('M d, Y h:i A', strtotime($ticket['updated_at'])); ?></span>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="../assets/js/admin.js"></script>

<?php include('../assets/includes/footer.php'); ?>
