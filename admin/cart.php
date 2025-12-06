<?php

session_start();

// --- 1. PHẦN LOGIC VÀ DỮ LIỆU ---

// Giỏ hàng mẫu (Để test, giả sử có 2 sản phẩm)
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        'SKU123' => [
            'id' => 'SKU123',
            'name' => 'Nike Air Force 1 \'07',
            'category' => 'Men\'s Shoes',
            'price' => 2849000,
            'size' => '42.5',
            'quantity' => 1,
            'image' => '../img/12.jpg' // Thay bằng ảnh test thực tế nếu cần
        ],
        'SKU456' => [
            'id' => 'SKU456',
            'name' => 'Nike Dunk Low Retro SE (Panda)',
            'category' => 'Men\'s Shoes',
            'price' => 2815199,
            'size' => '40',
            'quantity' => 2,
            'image' => '../img/giay3.jpg' // Thay bằng ảnh test thực tế nếu cần
        ],
    ];
}

// Dữ liệu sản phẩm gợi ý
$recommendations = [
    [
        'name' => 'Nike Dunk Low Retro SE',
        'category' => 'Men\'s Shoes',
        'price' => 2815199,
        'original_price' => 3519000,
        'image' => '../img/13.webp'
    ],
    [
        'name' => 'Nike Dunk Low Retro SE',
        'category' => 'Men\'s Shoes',
        'price' => 2815199,
        'original_price' => 3519000,
        'image' => '../img/12.jpg'
    ],
    [
        'name' => 'Nike Dunk Low Retro SE',
        'category' => 'Men\'s Shoes',
        'price' => 2815199,
        'original_price' => 3519000,
        'image' => '../img/10.webp'
    ],
    [
        'name' => 'Nike Dunk Low Retro SE',
        'category' => 'Men\'s Shoes',
        'price' => 2815199,
        'original_price' => 3519000,
        'image' => '../img/12.jpg'
    ]
];

// Hàm tính tổng phụ
function calculateSubtotal($cart) {
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

// Tính toán tổng tiền
$cart_items = $_SESSION['cart'];
$has_items = !empty($cart_items);
$subtotal = calculateSubtotal($cart_items);
$delivery_fee = 0; // Phí giao hàng miễn phí
$total = $subtotal + $delivery_fee;

// Hàm định dạng tiền VNĐ
function formatVND($amount) {
    return number_format($amount, 0, ',', '.') . '₫';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của tôi (<?php echo count($cart_items); ?>)</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* --- THIẾT LẬP CHUNG --- */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #111111;
        }

        a {
            color: #111111;
            text-decoration: none;
        }

        /* --- HEADER --- */
        .top-bar {
            background-color: #f5f5f5;
            padding: 5px 40px;
            display: flex;
            justify-content: flex-end;
            font-size: 12px;
        }
        
        .top-bar a {
            margin-left: 15px;
            color: #111111;
        }

        .header-main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 40px;
            border-bottom: 1px solid #eeeeee;
        }

        .logo {
            display: flex;
            align-items: center;
        }
        
        .main-nav {
            flex-grow: 1;
            text-align: center;
        }

        .main-nav a {
            margin: 0 15px;
            font-size: 16px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            border-radius: 20px;
            padding: 8px 15px;
            margin-right: 15px;
        }
        
        .search-box button {
            background: none;
            border: none;
            font-size: 16px;
            color: #111111;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            padding-left: 10px;
            width: 150px;
            font-size: 15px;
        }

        .header-actions button {
            background: none;
            border: none;
            cursor: pointer;
            margin-left: 10px;
            padding: 5px;
            color: #111111;
            font-size: 20px;
        }
        
        .header-actions button i.fa-heart {
            font-weight: 300;
        }
        
        .header-actions button i.fa-bag-shopping {
            font-weight: 900;
        }

        .promo-bar {
            text-align: center;
            background-color: #eeeeee;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        /* --- NỘI DUNG GIỎ HÀNG & TÓM TẮT --- */
        .cart-container {
            display: flex;
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 40px;
        }

        .cart-details {
            flex: 2;
            padding-right: 40px;
        }

        .cart-details h2 {
            font-size: 24px;
            margin-bottom: 30px;
        }
        
        /* ITEM TRONG GIỎ HÀNG */
        .cart-item {
            display: flex;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eeeeee;
        }
        
        .cart-item:last-of-type {
            border-bottom: none;
        }

        .item-image {
            width: 150px;
            height: 150px;
            margin-right: 20px;
            background-color: #f5f5f5;
            object-fit: cover;
        }
        
        .item-info {
            flex-grow: 1;
            display: flex;
            justify-content: space-between;
        }
        
        .item-details {
            display: flex;
            flex-direction: column;
        }
        
        .item-details h4 {
            font-size: 16px;
            margin: 0 0 5px 0;
        }
        
        .item-details p {
            font-size: 14px;
            color: #707070;
            margin: 2px 0;
        }
        
        .item-actions {
            margin-top: 10px;
        }
        
        .item-actions button {
            background: none;
            border: none;
            color: #707070;
            margin-right: 15px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .item-price {
            font-weight: bold;
            text-align: right;
        }
        
        .item-price span {
            font-size: 16px;
        }

        .favourites-heading {
            margin-top: 50px;
            font-size: 18px;
            font-weight: bold;
        }

        .cart-summary {
            flex: 1;
            padding: 20px;
        }

        .cart-summary h2 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
        }

        .summary-line.total-line {
            font-weight: bold;
            margin-top: 15px;
            font-size: 18px;
        }

        .cart-summary hr {
            border: 0;
            border-top: 1px solid #eeeeee;
            margin: 10px 0;
        }

        .member-checkout-btn {
            width: 100%;
            padding: 15px;
            background-color: #d3d3d3;
            color: #111111;
            border: none;
            border-radius: 30px;
            cursor: default;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        
        .member-checkout-btn.active {
            background-color: #111111;
            color: #ffffff;
            cursor: pointer;
        }

        .member-checkout-btn.active:hover {
            background-color: #555555;
        }
        
        /* --- SẢN PHẨM GỢI Ý --- */
        .recommendations {
            margin-top: 80px;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }

        .recommendations h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-grid {
            display: flex;
            gap: 20px;
            overflow-x: auto; 
            padding-bottom: 20px;
            -ms-overflow-style: none; 
            scrollbar-width: none;
        }
        
        .product-grid::-webkit-scrollbar {
            display: none;
        }

        .product-card {
            flex: 0 0 240px; 
            text-align: left;
            min-width: 240px;
            /* border: 1px solid #e0e0e0; */ /* Bỏ border để giống Nike hơn */
            padding-bottom: 10px;
        }
        
        /* .product-card:hover { border-color: #a0a0a0; } */ /* Bỏ hover border */

        .product-card img {
            width: 100%;
            height: auto;
            background-color: #f5f5f5;
        }

        .product-info {
            padding: 5px 0px; /* Giảm padding ngang */
        }

        .product-name {
            font-weight: 500;
            margin-top: 10px;
            line-height: 1.2;
        }

        .product-category {
            color: #707070;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .product-price {
            font-weight: bold;
            margin-top: 10px;
        }

        .product-original-price {
            color: #707070;
            text-decoration: line-through;
            font-size: 14px;
            margin-top: 2px;
        }

        /* --- FOOTER --- */
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

        .footer-columns a, .country-selector {
            color: #707070;
            font-size: 14px;
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
        }

    </style>
</head>

<body>

    <header class="main-header">
        <div class="top-bar">
            <a href="#">Find a Store</a>
            <a href="#">Help</a>
            <a href="../admin/signup.php">Join Us</a> 
            <a href="../admin/login.php">Sign In</a> 
        </div>
        
        <div class="header-main-nav">
            <div class="logo">
                <img src="../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="PKD SHOP" style="height: 30px;">
            </div>
            
            <nav class="main-nav">
                <a href="#">New & Featured</a>
                <a href="#">Men</a>
                <a href="#">Women</a>
                <a href="#">Kids</a>
                <a href="#">Sale</a>
            </nav>
            
            <div class="header-actions">
                <div class="search-box">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" placeholder="Search">
                </div>
                <button onclick="window.location.href='../admin/favorites.php'">
                    <i class="fa-regular fa-heart"></i>
                </button>
                <button onclick="window.location.href='cart.php'"> 
                    <i class="fa-solid fa-bag-shopping"></i>
                </button>
            </div>
        </div>
        
        <div class="promo-bar">
            Free Standard Delivery & 30-Day Free Returns | <a href="#">Join Now View Detail</a>
        </div>
    </header>

    <main class="cart-container">
        <section class="cart-details">
            <h2>Bag (<?php echo count($cart_items); ?>)</h2>
            
            <?php if (!$has_items): ?>
                <p>There are no items in your bag.</p>
            <?php else: ?>
                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <img class="item-image" src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        
                        <div class="item-info">
                            <div class="item-details">
                                <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                                <p><?php echo htmlspecialchars($item['category']); ?></p>
                                <p>Size: <?php echo htmlspecialchars($item['size']); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                                
                                <div class="item-actions">
                                    <button><i class="fa-regular fa-heart"></i> Move to Favourites</button>
                                    <button><i class="fa-solid fa-trash-can"></i> Remove</button>
                                </div>
                            </div>
                            
                            <div class="item-price">
                                <span><?php echo formatVND($item['price'] * $item['quantity']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>

            <h3 class="favourites-heading">Favourites</h3>
            <p>There are no items saved to your favourites.</p>

            <div class="recommendations">
                <h2>You Might Also Like</h2>
                <div class="product-grid">
                    <?php foreach ($recommendations as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        
                        <div class="product-info">
                            <p class="product-name"><?php echo htmlspecialchars($product['name']); ?></p>
                            <p class="product-category"><?php echo htmlspecialchars($product['category']); ?></p>
                            <p class="product-price"><?php echo formatVND($product['price']); ?></p>
                            <p class="product-original-price"><?php echo formatVND($product['original_price']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <aside class="cart-summary">
            <h2>Summary</h2>
            <div class="summary-line">
                <span>Subtotal</span>
                <span><?php echo $has_items ? formatVND($subtotal) : '—'; ?></span>
            </div>
            <div class="summary-line delivery-line">
                <span>Estimated Delivery & Handling</span>
                <span><?php echo $has_items ? 'Free' : '—'; ?></span>
            </div>
            <hr>
            <div class="summary-line total-line">
                <span>Total</span>
                <span><?php echo $has_items ? formatVND($total) : '—'; ?></span>
            </div>

            <button class="member-checkout-btn <?php echo $has_items ? 'active' : ''; ?>">
                Member checkout
            </button>
        </aside>
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
                <span style="margin-right: 5px;">🌍</span> Vietnam
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
</body>
</html>