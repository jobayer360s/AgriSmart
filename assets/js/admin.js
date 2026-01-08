function toggleForm(formId) {
    let form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}


function searchProducts() {
   let query = document.getElementById('searchInput').value;
    let resultsDiv = document.getElementById('searchResults');
    
    if (query.length < 2) {
        resultsDiv.innerHTML = '';
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/searchProducts.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("query=" + encodeURIComponent(query));
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    resultsDiv.innerHTML = response.html;
                } else {
                    resultsDiv.innerHTML = '<p class="error">' + response.message + '</p>';
                }
            } catch (e) {
                resultsDiv.innerHTML = '<p class="error">Error parsing response</p>';
            }
        }
    };
}

function searchUsers() {
   let query = document.getElementById('searchUser').value;
    let resultsDiv = document.getElementById('searchResults');
    
    if (query.length < 2) {
        resultsDiv.innerHTML = '';
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/searchUsers.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("query=" + encodeURIComponent(query));
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    resultsDiv.innerHTML = response.html;
                } else {
                    resultsDiv.innerHTML = '<p class="error">' + response.message + '</p>';
                }
            } catch (e) {
                resultsDiv.innerHTML = '<p class="error">Error parsing response</p>';
            }
        }
    };
}


function searchTipsLive() {
   let query = document.getElementById('searchTip').value;
    let resultsDiv = document.getElementById('searchResults');
    let tipsTable = document.getElementById('tipsTable');
    
    if (query.length < 2) {
        resultsDiv.innerHTML = '';
        if (tipsTable) tipsTable.style.display = 'block';
        return;
    }
    
    if (tipsTable) tipsTable.style.display = 'none';
    
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/searchTips.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("query=" + encodeURIComponent(query));
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    resultsDiv.innerHTML = response.html;
                } else {
                    resultsDiv.innerHTML = '<p class="error">' + response.message + '</p>';
                }
            } catch (e) {
                resultsDiv.innerHTML = '<p class="error">Error parsing response</p>';
            }
        }
    };
}

function updateOrderStatus(orderId) {
    let status = document.getElementById('status_' + orderId).value;
    let displayDiv = document.getElementById('statusDisplay_' + orderId);
    
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/updateOrderStatus.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("orderid=" + orderId + "&status=" + status);
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    displayDiv.innerHTML = 'Status updated successfully!';
                    displayDiv.style.color = '#28a745';
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    displayDiv.innerHTML = 'Failed to update status';
                    displayDiv.style.color = '#dc3545';
                }
            } catch (e) {
                displayDiv.innerHTML = 'Error processing response';
                displayDiv.style.color = '#dc3545';
            }
        }
    };
}

function updateTicketStatus(ticketId) {
    let status = document.getElementById('ticketStatus_' + ticketId).value;
    let displayDiv = document.getElementById('ticketDisplay_' + ticketId);
    
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/updateTicketStatus.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ticketid=" + ticketId + "&status=" + status);
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    displayDiv.innerHTML = 'Status updated!';
                    displayDiv.style.color = '#28a745';
                } else {
                    displayDiv.innerHTML = 'Update failed';
                    displayDiv.style.color = '#dc3545';
                }
            } catch (e) {
                displayDiv.innerHTML = 'Error processing response';
                displayDiv.style.color = '#dc3545';
            }
        }
    };
}


document.addEventListener('DOMContentLoaded', function() {
    
    let searchUser = document.getElementById('searchUser');
    if (searchUser) {
        searchUser.addEventListener('input', searchUsers);
    }
    
    let searchTip = document.getElementById('searchTip');
    if (searchTip) {
        searchTip.addEventListener('input', searchTipsLive);
    }
    
    let searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', searchProducts);
    }
});


