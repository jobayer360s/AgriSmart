// Chat JavaScript Functions

function sendChatMessage() {
    let message = document.getElementById('messageInput').value;
    let statusDiv = document.getElementById('sendStatus');
    
    if(message.trim() === '') {
        statusDiv.innerHTML = 'Please enter a message';
        statusDiv.style.color = '#dc3545';
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/sendMessage.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('receiver_id=' + receiverId + '&message=' + encodeURIComponent(message));
    
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText === 'success') {
                // Clear input
                document.getElementById('messageInput').value = '';
                statusDiv.innerHTML = 'Message sent!';
                statusDiv.style.color = '#28a745';
                
                // Reload messages
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                statusDiv.innerHTML = 'Failed to send message';
                statusDiv.style.color = '#dc3545';
            }
        }
    }
}

// Allow Enter key to send (Shift+Enter for new line)
document.addEventListener('DOMContentLoaded', function() {
    let msgInput = document.getElementById('messageInput');
    if(msgInput) {
        msgInput.addEventListener('keydown', function(e) {
            if(e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendChatMessage();
            }
        });
    }
});
