<?php
require_once(__DIR__ . '/db.php');


function getAllProducts() {
    $conn = getConnection();
    $sql = "SELECT * FROM shop_products ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    
    $products = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $products;
}

function getProductById($id) {
    $conn = getConnection();
    $sql = "SELECT * FROM shop_products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $product = null;
    if($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
    
    mysqli_close($conn);
    return $product;
}

function getProductsByCategory($category) {
    $conn = getConnection();
    $sql = "SELECT * FROM shop_products WHERE category = ? ORDER BY name ASC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $category);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $products = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $products;
}

function searchProducts($keyword) {
    $conn = getConnection();
    $keyword = "%$keyword%";
  
    $sql = "SELECT * FROM shop_products 
            WHERE name LIKE ? OR description LIKE ? OR category LIKE ?
            ORDER BY name ASC
            LIMIT 20";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $products = [];
    
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $products;
}


function addProduct($name, $description, $category, $price, $stock, $image = null) {
    $conn = getConnection();
    $sql = "INSERT INTO shop_products (name, description, category, price, stock, image) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssdis", $name, $description, $category, $price, $stock, $image);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    return $result;
}

function updateProduct($id, $name, $description, $category, $price, $stock, $image = null) {
    $conn = getConnection();
    
    if($image) {
        $sql = "UPDATE shop_products SET name = ?, description = ?, category = ?, 
                price = ?, stock = ?, image = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssdisi", $name, $description, $category, $price, $stock, $image, $id);
    } else {
        $sql = "UPDATE shop_products SET name = ?, description = ?, category = ?, 
                price = ?, stock = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssdii", $name, $description, $category, $price, $stock, $id);
    }
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    return $result;
}

function deleteProduct($id) {
    $conn = getConnection();
    $sql = "DELETE FROM shop_products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    return $result;
}

function getTotalProducts() {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as total FROM shop_products";
    $result = mysqli_query($conn, $sql);
    
    $count = 0;
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['total'];
    }
    
    mysqli_close($conn);
    return $count;
}

function getLowStockProducts($threshold = 10) {
    $conn = getConnection();
    $sql = "SELECT * FROM shop_products WHERE stock <= ? ORDER BY stock ASC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $threshold);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $products = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $products;
}

function updateProductStock($id, $quantity) {
    $conn = getConnection();
    $sql = "UPDATE shop_products SET stock = stock - ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $quantity, $id);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    return $result;
}

function checkProductStock($id, $quantity) {
    $conn = getConnection();
    $sql = "SELECT stock FROM shop_products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $available = false;
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $available = ($row['stock'] >= $quantity);
    }
    
    mysqli_close($conn);
    return $available;
}

function getProductsByIds($ids) {
    if(empty($ids)) return [];
    
    $conn = getConnection();
    $placeholders = str_repeat('?,', count($ids) - 1) . '?';
    $sql = "SELECT * FROM shop_products WHERE id IN ($placeholders)";
    $stmt = mysqli_prepare($conn, $sql);
    
    $types = str_repeat('i', count($ids));
    mysqli_stmt_bind_param($stmt, $types, ...$ids);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $products = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[$row['id']] = $row;
        }
    }
    
    mysqli_close($conn);
    return $products;
}

function getFeaturedProducts($limit = 6) {
    $conn = getConnection();
    $sql = "SELECT * FROM shop_products WHERE stock > 0 ORDER BY created_at DESC LIMIT ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $products = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $products;
}


function getProductCountByCategory() {
    $conn = getConnection();
    $sql = "SELECT category, COUNT(*) as count FROM shop_products GROUP BY category";
    $result = mysqli_query($conn, $sql);
    
    $categories = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $categories[$row['category']] = $row['count'];
        }
    }
    
    mysqli_close($conn);
    return $categories;
}
?>
