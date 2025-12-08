<?php
session_start();

// Khởi tạo danh sách yêu thích nếu chưa tồn tại
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = array();
}

// Lấy danh sách yêu thích
$favorite_items = $_SESSION['favorites'];
$has_favorites = !empty($favorite_items);

// Đường dẫn ảnh Logo (Đã được định nghĩa từ trước)
$logo_path = "../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg";

// Hàm định dạng tiền VNĐ (Đồng bộ với cart.php)
function formatVND($amount) {
    return number_format($amount, 0, ',', '.') . '₫';
}

// Dữ liệu sản phẩm mẫu cho phần "Find your next favourite"
// ĐÃ SỬA: CHUYỂN GIÁ SANG DẠNG SỐ NGUYÊN (INTEGER) ĐỂ TRÁNH LỖI ĐỊNH DẠNG.
$featured_products = array(
    array(
        'name' => 'Nike Dunk Low Retro SE',
        'category' => "Men's Shoes",
        'price_new' => 2815199, // Đã sửa sang int
        'price_old' => 3519000, // Đã sửa sang int
        'image' => '../img/1.webp'
    ),
    array(
        'name' => 'Nike Cortez Classic',
        'category' => "Men's Shoes",
        'price_new' => 2199000, // Đã sửa sang int
        'price_old' => 2500000, // Đã sửa sang int
        'image' => '../img/2.jpeg'
    ),
    array(
        'name' => 'Nike Cortez Black/White',
        'category' => "Men's Shoes",
        'price_new' => 2199000, // Đã sửa sang int
        'price_old' => 2500000, // Đã sửa sang int
        'image' => '../img/3.webp'
    ),
    array(
        'name' => 'Nike Cortez Khaki SE',
        'category' => "Women's Shoes",
        'price_new' => 2500000, // Đã sửa sang int
        'price_old' => 3000000, // Đã sửa sang int
        'image' => '../img/4.jpg'
    ),
    array(
        'name' => 'Nike Air Force 1',
        'category' => "Kids' Shoes",
        'price_new' => 1800000, // Đã sửa sang int
        'price_old' => 2200000, // Đã sửa sang int
        'image' => '../img/5.jpg'
    )
);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu Thích | Favourites (<?php echo count($favorite_items); ?>)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif;}
        body {background: #fff;}

        /* --- HEADER & NAVIGATION (Giữ nguyên) --- */
        .top-banner {
            width: 100%;
            background: #f0f0f0; 
            padding: 5px 40px;
            display: flex;
            justify-content: flex-end; 
            font-size: 13px;
            border-bottom: 1px solid #ddd;
        }
        .top-banner a {
            text-decoration: none;
            color: black;
            padding: 0 10px;
            border-left: 1px solid #ccc;
            line-height: 1; 
            cursor: pointer;
        }
        .top-banner a:first-child {
            border-left: none; 
        }
        .top-banner .sign-in-box {
            background-color: #e0e0e0; 
            padding: 0 10px;
            margin-left: 10px;
            display: flex;
        }
        .top-banner .sign-in-box a:first-child {
            border-left: none;
        }

        header {
            display: grid;
            grid-template-columns: auto 1fr auto; 
            align-items: center;
            padding: 15px 40px;
            width: 100%;
            background: white;
            border-bottom: 1px solid #eeeeee;
        }
        
        .logo img {
            width: 50px; 
            height: auto;
            display: block;
        }

        nav {
            display: flex;
            gap: 25px;
            justify-content: center; 
        }
        nav a {
            text-decoration: none;
            color: black;
            font-size: 15px;
            font-weight: 500;
            padding: 5px 0;
        }
        nav a:hover {
            border-bottom: 2px solid black;
        }

        .action-icons {
            display: flex;
            align-items: center;
            gap: 15px;
            justify-self: end;
        }
        .action-icons .search-box {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            border-radius: 20px;
            padding: 5px 15px;
            cursor: pointer;
        }
        .action-icons .search-box input {
            border: none;
            background: none;
            outline: none;
            padding: 5px;
            font-size: 14px;
            width: 150px;
        }
        .action-icons .search-box i {
            color: #555;
        }
        
        .action-icons a {
            text-decoration: none;
            color: inherit; 
            display: inline-block;
            line-height: 1; 
        }
        
        .action-icons .icon-btn {
            font-size: 20px;
            color: black;
            cursor: pointer;
        }
        .action-icons .icon-btn:hover {
            color: #555;
        }

        .delivery-bar-wrapper {
            width: 100%;
            background: #f0f0f0;
            padding: 10px 40px; 
            border-bottom: 1px solid #e0e0e0;
        }
        
        .delivery-bar {
            text-align: center;
            font-size: 14px;
        }
        .delivery-bar a {
            color: black;
            font-weight: bold;
        }
        /* --- KẾT THÚC HEADER & NAVIGATION --- */

        /* --- CONTENT FAVORITES (Giữ nguyên) --- */
        .main-content {
            padding: 40px 40px 80px;
            min-height: 50vh;
            max-width: 1200px;
            margin: 0 auto;
        }
        .favourites-section h1 {
            font-size: 28px;
            margin-bottom: 40px;
            font-weight: bold;
        }
        .empty-message {
            text-align: center;
            margin-top: 100px;
            font-size: 16px;
            color: #555;
        }

        /* Grid sản phẩm yêu thích */
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .favorite-card {
            position: relative;
        }

        .favorite-card img {
            width: 100%;
            height: auto;
            background: #f5f5f5;
            margin-bottom: 10px;
        }

        .fav-info h4 {
            font-size: 16px;
            margin: 5px 0 3px;
        }

        .fav-info p {
            font-size: 14px;
            color: #707070;
            margin: 2px 0;
        }

        .fav-info .price-new {
            font-weight: bold;
            color: black;
            margin-top: 5px;
        }

        .fav-info .price-old {
            color: #707070;
            text-decoration: line-through;
            font-size: 13px;
        }
        
        /* Nút Remove và Add to Bag */
        .fav-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .fav-actions .remove-btn,
        .fav-actions .add-btn {
            background: white;
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            color: black;
            font-size: 14px;
        }
        .fav-actions .add-btn {
            background: black;
            color: white;
            border: none;
        }
        
        /* Phần You Might Also Like */
        .recommended-section {
            margin-top: 80px;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }
        .recommended-section h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .recommended-grid {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .recommended-grid::-webkit-scrollbar {
            display: none;
        }
        
        /* Card sản phẩm gợi ý (sử dụng lại style .product-card nếu có) */
        .product-card {
            flex: 0 0 240px; 
            text-align: left;
            min-width: 240px;
            padding-bottom: 10px;
            position: relative;
        }
        .product-card img {
            width: 100%;
            height: auto;
            background-color: #f5f5f5;
        }
        .product-card .product-info {
            padding: 5px 0;
        }
        .product-card .product-info p {
            margin: 2px 0;
        }
        .product-card .product-name {
            font-weight: 500;
            margin-top: 10px;
            line-height: 1.2;
        }
        .product-card .product-category {
            color: #707070;
            font-size: 14px;
        }
        .product-card .product-price {
            font-weight: bold;
            margin-top: 10px;
        }
        .product-card .product-original-price {
            color: #707070;
            text-decoration: line-through;
            font-size: 14px;
        }
        
        /* CSS cho nút Add to Bag trong featured/recommended */
        .add-to-bag-btn {
            width: 100%;
            padding: 10px;
            text-align: center;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .add-to-bag-btn:hover {
            background: #333 !important; 
        }

        /* --- FOOTER (ĐÃ SỬA LỖI CẤU TRÚC) --- */
        .main-footer {
            background-color: #f5f5f5;
            color: #111111;
            padding: 40px 0 20px;
        }
        
        .footer-columns {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px 40px;
            gap: 30px; /* Thêm gap cho các cột */
        }

        .footer-columns h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #111111;
            font-weight: bold;
        }

        .footer-columns ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-columns li {
            margin-bottom: 8px;
        }

        .footer-columns a, .country-selector {
            color: #707070;
            font-size: 14px;
            text-decoration: none;
        }
        .footer-columns a:hover {
            color: #111111;
        }

        .country-selector {
            color: #111111;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .footer-bottom {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
        }

        .footer-bottom span {
            margin-right: 30px;
            font-size: 12px;
            color: #707070;
        }

        .footer-bottom a {
            color: #707070;
            margin-right: 20px;
            font-size: 12px;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="top-banner">
        <a href="#">Find a Store</a>
        <a href="#">Help</a>
        <div class="sign-in-box">
            <a href="../admin/signup.php">Join Us</a>
            <a href="../admin/login.php">Sign In</a>
        </div>
    </div>
    
    <header>
        <div class="logo">
            <img src="<?php echo $logo_path; ?>" alt="PKD SHOP">
        </div>
        
        <nav>
            <a href="#">New & Featured</a>
            <a href="products_men.php">Men</a>
            <a href="products_women.php">Women</a>
            <a href="products_kid.php">Kids</a>
            <a href="#">Sale</a>
        </nav>
        
        <div class="action-icons">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search">
            </div>
            <a href="favorites.php" class="icon-btn"><i class="fa-regular fa-heart"></i></a>
            <a href="cart.php" class="icon-btn"><i class="fa-solid fa-bag-shopping"></i></a>
        </div>
    </header>

    <div class="delivery-bar-wrapper">
        <div class="delivery-bar">
            Free Standard Delivery & 30-Day Free Returns | <a href="#">Join Now View Detail</a>
        </div>
    </div>

    <main class="main-content">
        <section class="favourites-section">
            <h1>Favourites (<?php echo count($favorite_items); ?>)</h1>
            
            <?php if ($has_favorites): ?>
                <div class="favorites-grid">
                    <?php foreach ($favorite_items as $key => $item): ?>
                        <div class="favorite-card">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            
                            <div class="fav-actions">
                                <a href="cart.php?action=add_from_favorites&key=<?php echo $key; ?>" class="add-btn" title="Add to Bag">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </a>
                                <a href="cart.php?action=remove_favorite&key=<?php echo $key; ?>" class="remove-btn" title="Remove from Favorites">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>

                            <div class="fav-info">
                                <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                                <p><?php echo htmlspecialchars($item['category']); ?></p>
                                <p>Size: <?php echo htmlspecialchars($item['size']); ?></p>
                                <p class="price-new"><?php echo formatVND($item['price']); ?></p>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="empty-message">You have no items in your Favourites. Sign in to sync your items.</p>
            <?php endif; ?>
        </section>

        <section class="recommended-section">
            <h2>Find your next favourite</h2>
            <div class="recommended-grid">
                <?php foreach ($featured_products as $key => $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    
                    <div class="product-info">
                        <p class="product-name"><?php echo htmlspecialchars($product['name']); ?></p>
                        <p class="product-category"><?php echo htmlspecialchars($product['category']); ?></p>
                        <p class="product-price"><?php echo formatVND($product['price_new']); ?></p>
                        <p class="product-original-price"><?= formatVND($product['price_old']) ?></p>
                    </div>
                    
                    <a href="cart.php?action=add_featured&key=<?= $key; ?>&redirect=favorites" class="add-to-bag-btn" style="position: static; border-radius: 5px; width: 100%; height: auto; margin-top: 10px; background: black; color: white;">
                        <i class="fa-solid fa-bag-shopping" style="margin-right: 5px;"></i> Add to Bag
                    </a>

                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

  <footer class="main-footer">
    <div class="footer-columns">
        <div>
            <h4>Resources</h4>
            <ul>
                <li><a href="#">Find A Store</a></li>
                <li><a href="#">Become A Member</a></li>
                <li><a href="#">Running Shoe Finder</a></li>
                <li><a href="#">PKD Coaching</a></li>
                <li><a href="#">Send Us Feedback</a></li>
            </ul>
        </div>
        <div>
            <h4>Help</h4>
            <ul>
                <li><a href="#">Get Help</a></li>
                <li><a href="#">Order Status</a></li>
                <li><a href="#">Delivery</a></li>
                <li><a href="#">Returns</a></li>
                <li><a href="#">Payment Options</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div>
            <h4>Company</h4>
            <ul>
                <li><a href="#">About Nike</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Investors</a></li>
                <li><a href="#">Sustainability</a></li>
                <li><a href="#">Impact</a></li>
                <li><a href="#">Report a Concern</a></li>
            </ul>
        </div>
        <div class="country-selector">
            <span>🌍</span> Vietnam
        </div>
    </div>
    <div class="footer-bottom">
        <span>© 2025 PKD, All rights reserved</span>
        <a href="#">Guides</a>
        <a href="#">Terms of Sale</a>
        <a href="#">Terms of Use</a>
        <a href="#">Nike Privacy Policy</a>
        <a href="#">Privacy Settings</a>
    </div>
</footer>

<style>
/* Footer */
.main-footer {
    background-color: #f5f5f5;
    color: #111111;
    padding-top: 40px;
    padding-bottom: 20px;
    font-family: Arial, sans-serif;
}

.footer-columns {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px 40px;
    gap: 30px;
}

.footer-columns h4 {
    font-size: 16px;
    margin-bottom: 15px;
    color: #111111;
    font-weight: bold;
}

.footer-columns ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-columns li {
    margin-bottom: 8px;
}

.footer-columns a,
.country-selector {
    color: #707070;
    font-size: 14px;
    text-decoration: none;
}

.footer-columns a:hover {
    color: #111111;
}

.country-selector {
    font-weight: bold;
    display: flex;
    align-items: center;
}

.footer-bottom {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 15px 40px 0;
    border-top: 1px solid #e0e0e0;
}

.footer-bottom span {
    margin-right: 30px;
    font-size: 12px;
    color: #707070;
}

.footer-bottom a {
    color: #707070;
    margin-right: 20px;
    font-size: 12px;
    text-decoration: none;
}

.footer-bottom a:hover {
    color: #111111;
}
</style>

</body>
</html>