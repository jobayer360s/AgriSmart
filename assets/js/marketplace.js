// Marketplace JavaScript Functions

// Add to Cart (AJAX)
function addToCart(productId, quantity = 1) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/addToCart.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("productid=" + productId + "&quantity=" + quantity);
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    showNotification(response.message, 'success');
                    updateCartCount(response.cart_count);
                } else {
                    showNotification(response.message, 'error');
                }
            } catch (e) {
                showNotification('Error adding to cart', 'error');
            }
        }
    };
}

// Update Cart Quantity (AJAX)
function updateCartQuantity(cartId, quantity) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/updateCartQuantity.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cartid=" + cartId + "&quantity=" + quantity);
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    showNotification(response.message, 'success');
                    updateCartTotal(response.cart_total);
                    location.reload(); // Reload to show updated prices
                } else {
                    showNotification(response.message, 'error');
                }
            } catch (e) {
                showNotification('Error updating quantity', 'error');
            }
        }
    };
}

// Remove from Cart (AJAX)
function removeFromCart(cartId) {
    if (!confirm('Remove this item from cart?')) {
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/removeFromCart.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cartid=" + cartId);
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    showNotification(response.message, 'success');
                    updateCartCount(response.cart_count);
                    location.reload();
                } else {
                    showNotification(response.message, 'error');
                }
            } catch (e) {
                showNotification('Error removing item', 'error');
            }
        }
    };
}

// Update Cart Count Badge
function updateCartCount(count) {
    let badge = document.getElementById('cart-count');
    if (badge) {
        badge.textContent = count;
        if (count > 0) {
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    }
}

// Update Cart Total
function updateCartTotal(total) {
    let totalElement = document.getElementById('cart-total');
    if (totalElement) {
        totalElement.textContent = '৳' + parseFloat(total).toFixed(2);
    }
}

// Show Notification
function showNotification(message, type = 'info') {
    let notification = document.createElement('div');
    notification.className = 'notification notification-' + type;
    notification.textContent = message;
    notification.style.cssText = 'position:fixed;top:20px;right:20px;padding:15px 25px;background:#28a745;color:white;border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,0.2);z-index:9999;animation:slideIn 0.3s;';
    
    if (type === 'error') {
        notification.style.background = '#dc3545';
    }
    
    document.body.appendChild(notification);
    
    setTimeout(function() {
        notification.remove();
    }, 3000);
}

// Filter Products by Category
function filterProducts(category) {
    let products = document.querySelectorAll('.product-card');
    
    products.forEach(function(product) {
        if (category === 'all' || product.dataset.category === category) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
    
    // Update active filter button
    document.querySelectorAll('.filter-btn').forEach(function(btn) {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
}

// Search Products in Shop
function searchShopProducts() {
    let query = document.getElementById('shopSearch').value.toLowerCase();
    let products = document.querySelectorAll('.product-card');
    
    products.forEach(function(product) {
        let name = product.dataset.name.toLowerCase();
        let description = product.dataset.description.toLowerCase();
        
        if (name.includes(query) || description.includes(query)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

// Quantity Controls
function incrementQuantity(inputId) {
    let input = document.getElementById(inputId);
    input.value = parseInt(input.value) + 1;
}

function decrementQuantity(inputId) {
    let input = document.getElementById(inputId);
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

// Initialize marketplace features
document.addEventListener('DOMContentLoaded', function() {
    // Add CSS animation for notifications
    let style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
});
