// Admin JavaScript Functions

function toggleForm(formId) {
    let form = document.getElementById(formId);
    if(form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}

function searchProducts() {
    let query = document.getElementById('searchInput').value;
    let resultsDiv = document.getElementById('searchResults');
    
    if(query.length < 2) {
        resultsDiv.innerHTML = '';
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/searchProducts.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('query=' + encodeURIComponent(query));
    
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            resultsDiv.innerHTML = this.responseText;
        }
    }
}

function searchUsers() {
    let query = document.getElementById('searchInput').value;
    let resultsDiv = document.getElementById('searchResults');
    
    if(query.length < 2) {
        resultsDiv.innerHTML = '';
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/searchUsers.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('query=' + encodeURIComponent(query));
    
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            resultsDiv.innerHTML = this.responseText;
        }
    }
}

function searchTipsLive() {
    let query = document.getElementById('searchInput').value;
    let resultsDiv = document.getElementById('searchResults');
    
    if(query.length < 2) {
        resultsDiv.innerHTML = '';
        document.getElementById('tipsList').style.display = 'block';
        return;
    }
    
    document.getElementById('tipsList').style.display = 'none';
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/searchTips.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('query=' + encodeURIComponent(query));
    
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            resultsDiv.innerHTML = this.responseText;
        }
    }
}

function updateOrderStatus(orderId) {
    let status = document.getElementById('status_' + orderId).value;
    let displayDiv = document.getElementById('statusDisplay_' + orderId);
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/updateOrderStatus.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('order_id=' + orderId + '&status=' + status);
    
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText === 'success') {
                displayDiv.innerHTML = 'Status updated successfully!';
                displayDiv.style.color = '#28a745';
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                displayDiv.innerHTML = 'Failed to update status';
                displayDiv.style.color = '#dc3545';
            }
        }
    }
}

function updateTicketStatus(ticketId) {
    let status = document.getElementById('ticketStatus_' + ticketId).value;
    let displayDiv = document.getElementById('ticketDisplay_' + ticketId);
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/updateTicketStatus.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('ticket_id=' + ticketId + '&status=' + status);
    
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText === 'success') {
                displayDiv.innerHTML = 'Status updated!';
                displayDiv.style.color = '#28a745';
            } else {
                displayDiv.innerHTML = 'Update failed';
                displayDiv.style.color = '#dc3545';
            }
        }
    }
}
