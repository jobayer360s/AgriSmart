<?php
require_once(__DIR__ . '/../models/shopProductModel.php');

if(isset($_POST['query'])) {
    $query = trim($_POST['query']);
    
    if(empty($query)) {
        echo '';
        exit;
    }
    
    $products = getAllShopProducts();
    $filtered = array_filter($products, function($product) use ($query) {
        return stripos($product['name'], $query) !== false || 
               stripos($product['category'], $query) !== false;
    });
    
    if(count($filtered) > 0) {
        echo '<table class="data-table">';
        echo '<thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Action</th></tr></thead>';
        echo '<tbody>';
        foreach($filtered as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['name']) . '</td>';
            echo '<td>' . $product['category'] . '</td>';
            echo '<td>৳' . number_format($product['price'], 2) . '</td>';
            echo '<td>' . $product['stock'] . '</td>';
            echo '<td><a href="edit_product.php?id=' . $product['id'] . '" class="btn-small">Edit</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No products found.</p>';
    }
}
?>
