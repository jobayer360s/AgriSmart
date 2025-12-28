<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart - Marketplace</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <div class="container">
        <h2>Marketplace</h2>
        
        <div class="grid">
            <?php
            require_once 'MarketplaceController.php';
            $controller = new MarketplaceController();
            $products = $controller->index();

            foreach ($products as $product): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><strong>Price:</strong> ₹<?php echo $product['price']; ?>/kg</p>
                    <p><strong>Available:</strong> <?php echo $product['quantity']; ?> kg</p>
                    <button class="btn" onclick="alert('Added to cart!')">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>