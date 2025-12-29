/**
 * Marketplace JavaScript
 */

// Load products on page load
document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
    setupEventListeners();
});

// Setup event listeners
function setupEventListeners() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');

    if (searchInput) {
        searchInput.addEventListener('keyup', filterProducts);
    }

    if (categoryFilter) {
        categoryFilter.addEventListener('change', filterProducts);
    }
}

// Load all products
function loadProducts() {
    const searchTerm = document.getElementById('searchInput')?.value || '';
    const category = document.getElementById('categoryFilter')?.value || '';

    // Demo products (in production, fetch from API)
    const allProducts = [
        {id: 1, name: 'Paddy Seeds', price: 500, category: 'seeds', stock: 50},
        {id: 2, name: 'Urea Fertilizer', price: 300, category: 'fertilizer', stock: 100},
        {id: 3, name: 'DAP Fertilizer', price: 450, category: 'fertilizer', stock: 75},
        {id: 4, name: 'Pesticide Spray', price: 200, category: 'pesticide', stock: 40},
        {id: 5, name: 'Wheat Seeds', price: 600, category: 'seeds', stock: 30},
        {id: 6, name: 'Potash Fertilizer', price: 350, category: 'fertilizer', stock: 60}
    ];

    let filtered = allProducts;

    if (searchTerm) {
        filtered = filtered.filter(p => 
            p.name.toLowerCase().includes(searchTerm.toLowerCase())
        );
    }

    if (category) {
        filtered = filtered.filter(p => p.category === category);
    }

    displayProducts(filtered);
}

// Filter products
function filterProducts() {
    loadProducts();
}

// Display products
function displayProducts(products) {
    const grid = document.getElementById('productsGrid');
    const emptyState = document.getElementById('emptyState');

    grid.innerHTML = '';

    if (products.length === 0) {
        grid.classList.add('hidden');
        emptyState.classList.remove('hidden');
        return;
    }

    grid.classList.remove('hidden');
    emptyState.classList.add('hidden');

    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <div class="product-image">🌾</div>
            <div class="product-body">
                <div class="product-name">${product.name}</div>
                <div class="product-price">${formatCurrency(product.price)}</div>
                <div class="product-category">${product.category}</div>
                <div class="product-stock">Stock: ${product.stock}</div>
                <div class="product-actions">
                    <input type="number" value="1" min="1" max="${product.stock}" class="qty-input">
                    <button class="btn btn-primary" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add</button>
                </div>
            </div>
        `;
        grid.appendChild(card);
    });
}

// Add to cart
function addToCart(productId, productName, price) {
    const qty = document.querySelector(`input[value="1"]`)?.value || 1;
    const cartSection = document.getElementById('cartSection');

    if (cartSection) {
        cartSection.classList.remove('hidden');
        addCartItem(productId, productName, price, parseInt(qty));
        showNotification(`${productName} added to cart!`, 'success');
    }
}

// Add item to cart
function addCartItem(productId, productName, price, quantity) {
    const cartBody = document.getElementById('cartBody');
    
    // Check if item already in cart
    const existingRow = cartBody.querySelector(`[data-id="${productId}"]`);
    
    if (existingRow) {
        const qtyInput = existingRow.querySelector('.qty-input');
        qtyInput.value = parseInt(qtyInput.value) + quantity;
        updateCartItem(existingRow);
    } else {
        const row = document.createElement('tr');
        row.setAttribute('data-id', productId);
        row.innerHTML = `
            <td>${productName}</td>
            <td>${formatCurrency(price)}</td>
            <td><input type="number" class="qty-input" value="${quantity}" min="1" onchange="updateCart()"></td>
            <td class="item-total">${formatCurrency(price * quantity)}</td>
            <td><button class="btn btn-danger" onclick="removeFromCart(${productId})">Remove</button></td>
        `;
        cartBody.appendChild(row);
    }

    updateCartTotal();
}

// Update cart item
function updateCartItem(row) {
    const price = parseFloat(row.cells[1].textContent.replace('৳', ''));
    const qty = parseInt(row.querySelector('.qty-input').value);
    row.querySelector('.item-total').textContent = formatCurrency(price * qty);
    updateCartTotal();
}

// Remove from cart
function removeFromCart(productId) {
    const cartBody = document.getElementById('cartBody');
    const row = cartBody.querySelector(`[data-id="${productId}"]`);
    
    if (row) {
        row.remove();
        showNotification('Item removed from cart', 'success');
        
        if (cartBody.children.length === 0) {
            document.getElementById('cartSection').classList.add('hidden');
        } else {
            updateCartTotal();
        }
    }
}

// Update cart total
function updateCartTotal() {
    const cartBody = document.getElementById('cartBody');
    let total = 0;

    cartBody.querySelectorAll('tr').forEach(row => {
        const price = parseFloat(row.cells[1].textContent.replace('৳', ''));
        const qty = parseInt(row.querySelector('.qty-input').value);
        total += price * qty;
    });

    document.getElementById('cartTotal').textContent = total.toFixed(2);
}

// Clear cart
function clearCart() {
    if (confirm('Are you sure you want to clear the cart?')) {
        document.getElementById('cartBody').innerHTML = '';
        document.getElementById('cartSection').classList.add('hidden');
        showNotification('Cart cleared', 'success');
    }
}

// Proceed to checkout
function proceedToCheckout() {
    const cartBody = document.getElementById('cartBody');
    
    if (cartBody.children.length === 0) {
        showNotification('Cart is empty', 'error');
        return;
    }

    // In production, submit order to API
    showNotification('Order placed successfully! Thank you for your purchase.', 'success');
    
    // Clear cart
    setTimeout(() => {
        clearCart();
        location.reload();
    }, 2000);
}
