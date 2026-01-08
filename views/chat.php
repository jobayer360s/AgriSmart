<?php
require_once('authCheck.php');
require_once(__DIR__ . '/../models/messageModel.php');
require_once(__DIR__ . '/../models/userModel.php');

if(!isset($_GET['user'])){
    header('location: chat_list.php');
    exit;
}

$contactId = $_GET['user'];
$contact = getUserById($contactId);

if(!$contact){
    header('location: chat_list.php');
    exit;
}

$messages = getMessages($_SESSION['user_id'], $contactId);
markMessagesAsRead($_SESSION['user_id'], $contactId);

$pageTitle = "Chat with " . $contact['username'];
include('../assets/includes/header.php');
?>

<div class="chat-container">
    <div class="chat-header-bar">
        <a href="chat_list.php" class="back-link">← Back</a>
        <div class="chat-user">
            <div class="chat-avatar">
                <?php echo strtoupper(substr($contact['username'], 0, 1)); ?>
            </div>
            <div>
                <h3><?php echo htmlspecialchars($contact['username']); ?></h3>
                <p style="font-size: 0.9em; opacity: 0.9;">
                    <span class="badge badge-<?php echo $contact['role']; ?>"><?php echo ucfirst($contact['role']); ?></span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="chat-messages-box" id="messagesBox">
        <?php foreach($messages as $msg): ?>
            <div class="message <?php echo $msg['sender_id'] == $_SESSION['user_id'] ? 'message-sent' : 'message-received'; ?>">
                <div class="message-bubble">
                    <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                </div>
                <div class="message-time">
                    <?php echo date('h:i A', strtotime($msg['created_at'])); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="chat-input-box">
        <form class="chat-form" id="chatForm">
            <textarea id="messageInput" name="message" placeholder="Type your message..." required></textarea>
            <button type="button" onclick="sendChatMessage()" class="btn">Send</button>
        </form>
        <div id="sendStatus" style="margin-top: 10px; font-size: 0.9em;"></div>
    </div>
</div>

<script src="../assets/js/chat.js"></script>
<script>
    // Scroll to bottom
    var msgBox = document.getElementById('messagesBox');
    msgBox.scrollTop = msgBox.scrollHeight;
    
    // Set receiver ID for controller
    var receiverId = <?php echo $contactId; ?>;
</script>

<?php include('../assets/includes/footer.php'); ?>
