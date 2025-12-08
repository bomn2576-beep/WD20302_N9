<?php
// ĐÃ SỬA: Thay db.php bằng config.php
include "config.php";

// Lấy sản phẩm women shoes
$sql = "SELECT id, name, price, image, category FROM nike_products WHERE category='women shoes'";
$results = $conn->query($sql);

// Kiểm tra lỗi query
if (!$results) {
    die("Query failed: " . $conn->error);
}

$products = [];

// Lấy dữ liệu từ DB
if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $products[] = $row;
    }
}

function format_currency($amount) {
    return number_format($amount, 0, ',', '.') . ' ₫';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giày Nữ - Nike</title>
    <link rel="stylesheet" href="style_sp.css">
</head>
<body>

    <div class="top-utility-nav">
        <div class="utility-links">
            <a href="#">Find a Store</a>
            <a href="#">Help</a>
            <a href="#">Join Us</a>
            <a href="#">Sign In</a>
        </div>
    </div>

    <header class="main-header">
        <div class="header-content">
            <div class="logo">NIKE</div>
            <nav class="main-nav">
            <a href="#">New & Featured</a>
                <a href="products_men.php">Men</a>
                <a href="products_women.php">Women</a>
                <a href="products_kid.php">Kids</a>
                <a href="#">Sale</a>
            </nav>
            <div class="header-icons">
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <span>🔍</span>
                </div>
                <span>♡</span>
                <span>🛒</span>
            </div>
        </div>
    </header>
    
    <div class="shipping-info-bar">
        Free Standard Delivery & 30-Day Free Returns | <a href="#">Join Now</a>
    </div>

    <div class="container">
        <aside class="sidebar">
            <h2>Women</h2>
            <ul>
                <li><a href="#">Shoes</a></li>
                <li><a href="#">Tops</a></li>
                <li><a href="#">Hoodies</a></li>
            </ul>
        </aside>

        <main class="product-content">
            <div class="product-toolbar">
                <span>Hide Filters ⑆</span>
                <span>Sort By ⌄</span>
            </div>

            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <a href="add_to_cart.php?id=<?php echo $product['id']; ?>&name=<?php echo urlencode($product['name']); ?>&price=<?php echo $product['price']; ?>&image=<?php echo urlencode($product['image']); ?>&category=<?php echo urlencode($product['category']); ?>">
                            <img src="<?php echo $product['image']; ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="product-image">

                            <div class="product-info">
                                <div class="product-name">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </div>

                                <div class="product-price">
                                    <?php echo format_currency($product['price']); ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </main>
    </div>

</body>
</html>