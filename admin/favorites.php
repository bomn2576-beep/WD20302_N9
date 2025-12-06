<?php
session_start();

// --- LOGIC PHP GIẢ ĐỊNH ---

// 1. Kiểm tra đăng nhập (có thể bỏ comment đoạn dưới nếu bạn cần)
/*
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
*/

// Đường dẫn ảnh Logo (Đã được định nghĩa từ trước)
$logo_path = "../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg";

// 2. Dữ liệu sản phẩm mẫu cho phần cuộn ngang
// BẠN THAY ĐỔI ĐƯỜNG DẪN ẢNH NÀY ĐỂ TRỎ ĐẾN ẢNH SẢN PHẨM THỰC TẾ CỦA BẠN TRONG THƯ MỤC IMG/
$featured_products = [
    [
        'name' => 'Nike Dunk Low Retro SE',
        'category' => "Men's Shoes",
        'price_new' => '2,815,199₫',
        'price_old' => '3,519,000₫',
        'image' => '../img/1.webp' // Sử dụng file ảnh mẫu 1.webp
    ],
    [
        'name' => 'Nike Cortez Classic',
        'category' => "Men's Shoes",
        'price_new' => '2,199,000₫',
        'price_old' => '2,500,000₫',
        'image' => '../img/2.jpeg' // Sử dụng file ảnh mẫu 2.jpeg
    ],
    [
        'name' => 'Nike Cortez Black/White',
        'category' => "Men's Shoes",
        'price_new' => '2,199,000₫',
        'price_old' => '2,500,000₫',
        'image' => '../img/3.webp' // Sử dụng file ảnh mẫu 3.webp
    ],
    [
        'name' => 'Nike Cortez Khaki SE',
        'category' => "Women's Shoes",
        'price_new' => '2,500,000₫',
        'price_old' => '3,000,000₫',
        'image' => '../img/4.jpg' // Sử dụng file ảnh mẫu 4.jpg
    ],
    [
        'name' => 'Nike Air Force 1',
        'category' => "Kids' Shoes",
        'price_new' => '1,800,000₫',
        'price_old' => '2,200,000₫',
        'image' => '../img/5.jpg' // Sử dụng file ảnh mẫu 5.jpg
    ]
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu Thích | Favourites</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family: Arial, sans-serif;}
        body{background:#fff;}

        /* --- HEADER & NAVIGATION --- */
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

        header{
            display: grid;
            grid-template-columns: auto 1fr auto; 
            align-items: center;
            padding: 15px 40px;
            width:100%;
            background:white;
        }
        
        .logo img {
            width: 50px; 
            height: auto;
            display: block;
        }

        nav{
            display:flex;
            gap:25px;
            justify-content: center; 
        }
        nav a{
            text-decoration:none;
            color:black;
            font-size:15px;
            font-weight: 500;
            padding: 5px 0;
        }
        nav a:hover {
            border-bottom: 2px solid black;
        }

        .action-icons{
            display:flex;
            align-items:center;
            gap: 15px;
            justify-self: end;
        }
        .action-icons .search-box{
            display:flex;
            align-items:center;
            background:#f5f5f5;
            border-radius:20px;
            padding:5px 15px;
            cursor: pointer;
        }
        .action-icons .search-box input{
            border: none;
            background: none;
            outline: none;
            padding: 5px;
            font-size: 14px;
            width: 150px;
        }
        .action-icons .search-box i{
            color: #555;
        }
        
        /* Đảm bảo thẻ <a> bao quanh icon không làm mất style của icon */
        .action-icons a {
            text-decoration: none;
            color: inherit; /* Kế thừa màu sắc */
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

        /* --- CONTENT FAVORITES --- */
        .main-content {
            padding: 40px 40px 80px;
            min-height: 50vh;
        }
        .favourites-section h1 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .empty-message {
            text-align: center;
            margin-top: 100px;
            font-size: 16px;
            color: #555;
        }

        /* --- SẢN PHẨM CUỘN NGANG --- */
        .products-scroll-section {
            padding: 50px 0;
        }
        .products-scroll-section h3 {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 20px;
            padding: 0 40px;
        }
        .product-carousel {
            display: flex;
            overflow-x: scroll; /* Kích hoạt cuộn ngang */
            padding: 0 40px 20px; /* Thêm padding cho các cạnh và dưới để dễ cuộn */
            gap: 15px;
            -webkit-overflow-scrolling: touch; /* Tăng tốc độ cuộn trên thiết bị di động */
        }
        /* Tùy chỉnh thanh cuộn (cho Chrome/Edge/Safari) */
        .product-carousel::-webkit-scrollbar {
            height: 8px;
        }
        .product-carousel::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }
        
        .product-card {
            flex: 0 0 auto; /* Ngăn không cho các card co lại */
            width: 300px; /* Chiều rộng cố định cho mỗi card */
            cursor: pointer;
        }
        .product-card img {
            width: 100%;
            height: auto;
            background: #f5f5f5; /* Nền xám nhạt cho vùng ảnh */
            margin-bottom: 10px;
        }
        .product-card .info {
            padding: 5px 0;
        }
        .product-card .info p {
            margin: 3px 0;
            font-size: 14px;
        }
        .product-card .info .name {
            font-weight: bold;
            font-size: 15px;
        }
        .product-card .info .category {
            color: #777;
        }
        .product-card .info .price-new {
            color: black;
            font-weight: 500;
        }
        .product-card .info .price-old {
            color: #777;
            text-decoration: line-through;
            margin-left: 8px;
        }


        /* --- FOOTER --- */
        footer{margin-top:80px;padding:40px;background:#f5f5f5;}
        .footer-grid{
            max-width: 1200px; 
            margin: 0 auto;
            display:grid;
            grid-template-columns: repeat(4, 1fr); 
            gap:30px;
        }
        .footer-grid h4{margin-bottom:12px;}
        .footer-grid a{display:block;margin:6px 0;text-decoration:none;color:#333;font-size:14px;}
        .footer-country {
            text-align: right;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="top-banner">
    <div class="top-links">
        <a href="#">Find a Store</a>
        <a href="#">Help</a>
        <a href="signup.php">Join Us</a>
    </div>
    <div class="sign-in-box">
        <a href="login.php">Sign In</a>
    </div>
</div>

<header>
    <div class="logo">
        <img src="<?= $logo_path ?>" alt="Logo">
    </div>
    
    <nav>
        <a href="#">New & Featured</a>
        <a href="#">Men</a>
        <a href="#">Women</a>
        <a href="#">Kids</a>
        <a href="#">Sale</a>
    </nav>

    <div class="action-icons">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
        
        <a href="favorites.php">
            <i class="fas fa-heart icon-btn" style="color: black;"></i> 
        </a>
        
        <a href="cart.php"> 
            <i class="fas fa-shopping-bag icon-btn"></i>
        </a>
    </div>
</header>

<div class="delivery-bar-wrapper">
    <div class="delivery-bar">
        Free Standard Delivery & 30-Day Free Returns | <a href="#">Join Now</a> | <a href="#">View Detail</a>
    </div>
</div>
<div class="main-content">
    <div class="favourites-section">
        <h1>Favourites</h1>
        <div class="empty-message">
            Items added to your Favourites will be saved here.
            <p style="margin-top: 15px;">
                <a href="#" style="color: black; text-decoration: underline; font-weight: bold;">Shop Now</a>
            </p>
        </div>
    </div>
</div>

<div class="products-scroll-section">
    <h3>Find your next favourite</h3>
    <div class="product-carousel">
        <?php foreach ($featured_products as $product): ?>
            <div class="product-card">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <div class="info">
                    <p class="name"><?= $product['name'] ?></p>
                    <p class="category"><?= $product['category'] ?></p>
                    <p>
                        <span class="price-new"><?= $product['price_new'] ?></span>
                        <span class="price-old"><?= $product['price_old'] ?></span>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($featured_products as $product): ?>
            <div class="product-card">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <div class="info">
                    <p class="name"><?= $product['name'] ?></p>
                    <p class="category"><?= $product['category'] ?></p>
                    <p>
                        <span class="price-new"><?= $product['price_new'] ?></span>
                        <span class="price-old"><?= $product['price_old'] ?></span>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<footer>
    <div class="footer-grid">
        <div>
            <h4>Resources</h4>
            <a href="#">Find A Store</a>
            <a href="#">Become A Member</a>
            <a href="#">Running Shoe Finder</a>
            <a href="#">PKD Coaching</a>
            <a href="#">Send Us Feedback</a>
        </div>

        <div>
            <h4>Help</h4>
            <a href="#">Get Help</a>
            <a href="#">Order Status</a>
            <a href="#">Delivery</a>
            <a href="#">Returns</a>
            <a href="#">Payment Options</a>
            <a href="#">Contact Us</a>
        </div>

        <div>
            <h4>Company</h4>
            <a href="#">About Nike</a>
            <a href="#">News</a>
            <a href="#">Careers</a>
            <a href="#">Investors</a>
            <a href="#">Sustainability</a>
            <a href="#">Impact</a>
            <a href="#">Report a Concern</a>
        </div>
        
        <div class="footer-country">
            <i class="fas fa-globe"></i> Vietnam
        </div>
    </div>
</footer>

</body>
</html>