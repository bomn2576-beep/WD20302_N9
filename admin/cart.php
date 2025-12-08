<?php

session_start();

// --- 1. PHẦN LOGIC VÀ DỮ LIỆU ---

// Khởi tạo giỏ hàng và danh sách yêu thích nếu chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = array();
}

// Dữ liệu sản phẩm gợi ý (Giữ nguyên)
$recommendations = array(
    array(
        'id' => 101, // ID duy nhất cho sản phẩm gợi ý (ví dụ)
        'name' => 'Nike Dunk Low Retro SE',
        'category' => 'Men\'s Shoes',
        'price' => 2815199,
        'original_price' => 3519000,
        'image' => '../img/13.webp'
    ),
    array(
        'id' => 102,
        'name' => 'Air Jordan 1 Low SE',
        'category' => 'Women\'s Shoes',
        'price' => 2500000,
        'original_price' => 3000000,
        'image' => '../img/12.jpg'
    ),
    array(
        'id' => 103,
        'name' => 'Nike Sportswear Tech Fleece',
        'category' => 'Men\'s T-Shirt',
        'price' => 1200000,
        'original_price' => 1500000,
        'image' => '../img/10.webp'
    ),
    array(
        'id' => 104,
        'name' => 'Nike Blazer Mid 77',
        'category' => 'Kids\' Shoes',
        'price' => 1800000,
        'original_price' => 2200000,
        'image' => '../img/12.jpg' // Dùng lại ảnh ví dụ
    )
);

// DỮ LIỆU SẢN PHẨM TỪ MỤC "FIND YOUR NEXT FAVOURITE" CỦA favorites.php
// ĐÃ SỬA: CHUYỂN GIÁ SANG DẠNG SỐ NGUYÊN (INTEGER) ĐỂ ĐỒNG BỘ.
$featured_products_for_cart = array(
    array(
        'name' => 'Nike Dunk Low Retro SE',
        'category' => "Men's Shoes",
        'price_new' => 2815199, 
        'price_old' => 3519000, 
        'image' => '../img/1.webp'
    ),
    array(
        'name' => 'Nike Cortez Classic',
        'category' => "Men's Shoes",
        'price_new' => 2199000, 
        'price_old' => 2500000, 
        'image' => '../img/2.jpeg'
    ),
    array(
        'name' => 'Nike Cortez Black/White',
        'category' => "Men's Shoes",
        'price_new' => 2199000, 
        'price_old' => 2500000, 
        'image' => '../img/3.webp'
    ),
    array(
        'name' => 'Nike Cortez Khaki SE',
        'category' => "Women's Shoes",
        'price_new' => 2500000, 
        'price_old' => 3000000, 
        'image' => '../img/4.jpg'
    ),
    array(
        'name' => 'Nike Air Force 1',
        'category' => "Kids' Shoes",
        'price_new' => 1800000, 
        'price_old' => 2200000, 
        'image' => '../img/5.jpg'
    )
);


// Hàm kiểm tra và thêm/cập nhật số lượng sản phẩm vào giỏ hàng
function addToCart($product_data) {
    // Luôn giả định size là 'S' vì không có logic chọn size
    // Cố gắng tìm ID từ dữ liệu (hoặc gán ID ngẫu nhiên nếu không có)
    $product_id = isset($product_data['id']) ? (int)$product_data['id'] : (isset($product_data['name']) ? crc32($product_data['name'] . $product_data['category']) : rand(10000, 99999));
    $product_size = 'S'; 
    $product_quantity = 1;

    // Kiểm tra và tăng số lượng nếu sản phẩm đã tồn tại
    $item_exists = false;
    foreach ($_SESSION['cart'] as $cart_key => &$item) { // Dùng & để thay đổi giá trị trực tiếp
        if (isset($item['id']) && $item['id'] == $product_id && $item['size'] == $product_size) { 
            $item['quantity']++; // Tăng số lượng lên 1
            $item_exists = true;
            break;
        }
    }
    unset($item);

    if (!$item_exists) {
        // Xử lý giá: nếu có price_new (từ featured) thì dùng nó, ngược lại dùng price
        $price_value = isset($product_data['price']) ? $product_data['price'] : (isset($product_data['price_new']) ? $product_data['price_new'] : 0);
        
        // Thêm sản phẩm mới vào giỏ hàng
        $new_item = array(
            'id' => $product_id, // Quan trọng: Phải thêm ID để kiểm tra trùng lặp
            'name' => $product_data['name'] ?? 'Sản phẩm không tên',
            'category' => $product_data['category'] ?? 'N/A',
            'price' => (int)$price_value, // Đảm bảo giá là số nguyên
            'image' => $product_data['image'] ?? '',
            'size' => $product_size, 
            'quantity' => $product_quantity
        );
        $_SESSION['cart'][] = $new_item;
    }
}


// --- XỬ LÝ HÀNH ĐỘNG GIỎ HÀNG (REMOVE, FAVORITE, ADD) ---

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    $key = isset($_GET['key']) ? (int)$_GET['key'] : -1; // Index trong $_SESSION['cart'] hoặc $_SESSION['favorites']
    $rec_id = isset($_GET['rec_id']) ? (int)$_GET['rec_id'] : -1; // ID trong $recommendations

    if ($action == 'remove' && $key >= 0 && isset($_SESSION['cart'][$key])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$key]);
        // Cần dùng array_values() để reset index sau khi unset
        $_SESSION['cart'] = array_values($_SESSION['cart']);

    } elseif ($action == 'favorite' && $key >= 0 && isset($_SESSION['cart'][$key])) {
        // Chuyển sản phẩm sang yêu thích
        $item_to_move = $_SESSION['cart'][$key];
        
        // Kiểm tra trùng lặp trong favorites trước khi thêm
        $fav_exists = false;
        if (isset($item_to_move['id'])) {
            foreach ($_SESSION['favorites'] as $fav_item) {
                if ($fav_item['id'] == $item_to_move['id'] && $fav_item['size'] == $item_to_move['size']) {
                    $fav_exists = true;
                    break;
                }
            }
        }

        if (!$fav_exists) {
            // Chỉ giữ lại 1 sản phẩm với size 'S' trong favorites
            $_SESSION['favorites'][] = array(
                'id' => $item_to_move['id'],
                'name' => $item_to_move['name'],
                'category' => $item_to_move['category'],
                'price' => $item_to_move['price'], // Giá là số nguyên đã được đảm bảo
                'image' => $item_to_move['image'],
                'size' => $item_to_move['size'],
                'quantity' => 1 
            );
        }
        
        // Xóa khỏi giỏ hàng (Luôn xóa)
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);

    } elseif ($action == 'add_from_recommendation' && $rec_id >= 0) {
        // Thêm sản phẩm từ RECOMMENDATIONS (ở trang cart)
        $found_product = null;
        foreach ($recommendations as $rec) {
            if ($rec['id'] == $rec_id) {
                $found_product = $rec;
                break;
            }
        }
        if ($found_product) {
            addToCart($found_product);
        }
    
    // --- BỔ SUNG: XỬ LÝ TỪ MỤC FIND YOUR NEXT FAVOURITE (favorites.php) ---
    } elseif ($action == 'add_featured' && $key >= 0 && isset($featured_products_for_cart[$key])) {
        $item_to_add = $featured_products_for_cart[$key];
        
        // **KHÔNG CẦN CHUYỂN ĐỔI GIÁ NỮA** vì giá đã là số nguyên trong mảng $featured_products_for_cart
        // $price_string = str_replace(array('.', '₫'), '', $item_to_add['price_new']);
        $item_to_add['price'] = (int)$item_to_add['price_new']; 
        
        // Gán ID tạm thời (nếu dữ liệu ban đầu không có ID)
        $item_to_add['id'] = $item_to_add['id'] ?? (crc32($item_to_add['name'] . $item_to_add['category']));
        
        // Thêm vào giỏ hàng
        addToCart($item_to_add);
        
        // Chuyển hướng trở lại trang favorites.php
        if (isset($_GET['redirect']) && $_GET['redirect'] == 'favorites') {
            header('Location: favorites.php');
            exit();
        }

    // --- XỬ LÝ TỪ TRANG FAVORITES (action=add_from_favorites) ---
    } elseif ($action == 'add_from_favorites' && $key >= 0 && isset($_SESSION['favorites'][$key])) {
        $item_to_move = $_SESSION['favorites'][$key];
        
        // Thêm vào giỏ hàng (sử dụng hàm mới để xử lý tăng số lượng)
        addToCart($item_to_move);
        
        // Xóa khỏi favorites (sau khi chuyển qua giỏ hàng)
        unset($_SESSION['favorites'][$key]);
        $_SESSION['favorites'] = array_values($_SESSION['favorites']);

    // --- XỬ LÝ XÓA KHỎI TRANG FAVORITES (action=remove_favorite) ---
    } elseif ($action == 'remove_favorite' && $key >= 0 && isset($_SESSION['favorites'][$key])) {
        // Xóa sản phẩm khỏi danh sách yêu thích
        unset($_SESSION['favorites'][$key]);
        $_SESSION['favorites'] = array_values($_SESSION['favorites']);
        // Chuyển hướng về trang favorites
        header('Location: favorites.php');
        exit();
    }

    // Chuyển hướng lại về trang giỏ hàng (trừ trường hợp xóa khỏi favorites hoặc redirect đặc biệt)
    header('Location: cart.php');
    exit();
}

// Hàm tính tổng phụ (Đã thêm kiểm tra khóa an toàn)
function calculateSubtotal($cart) {
    $subtotal = 0;
    foreach ($cart as $item) {
        $price = isset($item['price']) ? $item['price'] : 0;
        $quantity = isset($item['quantity']) ? $item['quantity'] : 0;
        $subtotal += $price * $quantity;
    }
    return $subtotal;
}

// Tính toán tổng tiền
$cart_items = $_SESSION['cart'];
$has_items = !empty($cart_items);
$subtotal = calculateSubtotal($cart_items);
$delivery_fee = 0; // Phí giao hàng miễn phí
$total = $subtotal + $delivery_fee;
$favorite_count = count($_SESSION['favorites']);

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
        /* CSS tương tự như bạn đã cung cấp */
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
        
        .item-actions a { /* Sửa từ button thành a cho liên kết hành động */
            background: none;
            border: none;
            color: #707070;
            margin-right: 15px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none; /* đảm bảo không có gạch chân */
            padding: 0; /* loại bỏ padding mặc định của button nếu có */
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
            padding-bottom: 10px;
            position: relative; /* Thêm position relative để định vị nút Add */
        }
        
        .product-card img {
            width: 100%;
            height: auto;
            background-color: #f5f5f5;
        }

        .product-info {
            padding: 5px 0px; 
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

        /* Nút Add to Bag trong Recommendation */
        .add-to-bag-btn {
            position: absolute;
            bottom: 150px; /* Điều chỉnh vị trí nút */
            right: 10px;
            background-color: #111111;
            color: #ffffff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .add-to-bag-btn:hover {
            background-color: #555555;
        }

        /* --- FOOTER (Giữ nguyên) --- */
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
                <a href="products_men.php">Men</a> <a href="products_women.php">Women</a> <a href="products_kid.php">Kids</a> <a href="#">Sale</a>
            </nav>
            
            <div class="header-actions">
                <div class="search-box">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" placeholder="Search">
                </div>
                <button onclick="window.location.href='favorites.php'">
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
                <?php foreach ($cart_items as $key => $item): // Thêm $key vào vòng lặp ?>
                    <?php 
                        // Kiểm tra các khóa trước khi truy cập để tránh lỗi Undefined array key
                        $item_name = isset($item['name']) ? htmlspecialchars($item['name']) : 'Sản phẩm không tên';
                        $item_category = isset($item['category']) ? htmlspecialchars($item['category']) : 'N/A';
                        $item_size = isset($item['size']) ? htmlspecialchars($item['size']) : 'N/A';
                        $item_quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                        $item_price = isset($item['price']) ? (float)$item['price'] : 0;
                        $item_image = isset($item['image']) ? htmlspecialchars($item['image']) : '';
                    ?>
                    <div class="cart-item">
                        <img class="item-image" src="<?php echo $item_image; ?>" alt="<?php echo $item_name; ?>">
                        
                        <div class="item-info">
                            <div class="item-details">
                                <h4><?php echo $item_name; ?></h4>
                                <p><?php echo $item_category; ?></p>
                                <p>Size: <?php echo $item_size; ?></p>
                                <p>Quantity: <?php echo $item_quantity; ?></p>
                                
                                <div class="item-actions">
                                    <a href="cart.php?action=favorite&key=<?php echo $key; ?>"><i class="fa-regular fa-heart"></i> Move to Favourites</a>
                                    <a href="cart.php?action=remove&key=<?php echo $key; ?>"><i class="fa-solid fa-trash-can"></i> Remove</a>
                                </div>
                            </div>
                            
                            <div class="item-price">
                                <span><?php echo formatVND($item_price * $item_quantity); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>

            <h3 class="favourites-heading">Favourites (<?php echo $favorite_count; ?>)</h3>
            <?php if ($favorite_count == 0): ?>
                <p>There are no items saved to your favourites.</p>
            <?php else: ?>
                <p>Bạn có <a href="favorites.php" style="font-weight: bold; text-decoration: underline;"><?php echo $favorite_count; ?> sản phẩm</a> trong danh sách yêu thích. <a href="favorites.php" style="text-decoration: none; color: #707070;">(View Favourites)</a></p>
            <?php endif; ?>

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
                        <a href="cart.php?action=add_from_recommendation&rec_id=<?php echo $product['id']; ?>" class="add-to-bag-btn">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </a>
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

            <button class="member-checkout-btn <?php echo $has_items ? 'active' : ''; ?>" 
        <?php echo $has_items ? 'onclick="window.location.href=\'../admin/thanhtoan.php\'"' : ''; ?>>
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