/**
 * Main JavaScript - Global Functions
 */

// Show notification
function showNotification(message, type = 'info') {
    const container = document.getElementById('notificationContainer');
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <strong>${type.toUpperCase()}</strong>: ${message}
    `;
    container.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 4000);
}

// Format currency
function formatCurrency(value) {
    return '৳' + parseFloat(value).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

// Format date
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

// Validate email
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Validate password
function validatePassword(password) {
    return password.length >= 8;
}

// Check if user is logged in
async function checkLoginStatus() {
    try {
        const response = await fetch('api/auth/status.php');
        const data = await response.json();
        return data.logged_in;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

// Redirect to login
function redirectToLogin() {
    window.location.href = 'index.php?page=auth';
}

// Document ready
document.addEventListener('DOMContentLoaded', function() {
    // Add any global initialization here
    console.log('AgriSmart loaded successfully');
});
