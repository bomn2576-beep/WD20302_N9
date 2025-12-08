<?php
// Tên file: header.php

// Hàm định dạng tiền VNĐ (Nếu cần dùng trong header)
if (!function_exists('formatVND')) {
    function formatVND($amount) {
        return number_format($amount, 0, ',', '.') . '₫';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKD SHOP | Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* CSS CƠ BẢN ĐỂ DỄ DÀNG THIẾT KẾ */
        * {margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif;}
        body {background: #fff; line-height: 1.5;}

        /* --- HEADER & NAVIGATION --- */
        .top-banner {
            width: 100%; background: #f0f0f0; padding: 5px 40px;
            display: flex; justify-content: flex-end; font-size: 13px; border-bottom: 1px solid #ddd;
        }
        .top-banner a {
            text-decoration: none; color: black; padding: 0 10px;
            border-left: 1px solid #ccc; line-height: 1; cursor: pointer;
        }
        .top-banner .sign-in-box {
            background-color: #e0e0e0; padding: 0 10px; margin-left: 10px; display: flex;
        }
        header {
            display: grid; grid-template-columns: auto 1fr auto; align-items: center;
            padding: 15px 40px; width: 100%; background: white; border-bottom: 1px solid #eeeeee;
        }
        .logo img { width: 50px; height: auto; display: block; }
        nav { display: flex; gap: 25px; justify-content: center; }
        nav a { text-decoration: none; color: black; font-size: 15px; font-weight: 500; padding: 5px 0; }
        .action-icons { display: flex; align-items: center; gap: 15px; justify-self: end; }
        .action-icons .search-box { display: flex; align-items: center; background: #f5f5f5; border-radius: 20px; padding: 5px 15px; cursor: pointer; }
        .action-icons .search-box input { border: none; background: none; outline: none; padding: 5px; font-size: 14px; width: 150px; }
        .action-icons .icon-btn { font-size: 20px; color: black; cursor: pointer; }
        
        .delivery-bar-wrapper {
            width: 100%; background: #f0f0f0; padding: 10px 40px; border-bottom: 1px solid #e0e0e0;
        }
        .delivery-bar { text-align: center; font-size: 14px; }
        .delivery-bar a { color: black; font-weight: bold; }

        /* --- CONTAINER CHÍNH & FEATURED (CSS của nội dung chính) --- */
        .main-container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }
        .featured-section { padding: 40px 0; }
        .featured-section h2 { font-size: 32px; font-weight: 800; margin-bottom: 20px; }
        .featured-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .featured-card { position: relative; height: 400px; overflow: hidden; border-radius: 5px; }
        .featured-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
        .featured-card::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        }
        .featured-content { position: absolute; bottom: 30px; left: 30px; color: white; z-index: 10; }
        .featured-content h3 { font-size: 28px; margin-bottom: 5px; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); }
        .featured-content p { font-size: 16px; margin-bottom: 15px; text-shadow: 1px 1px 2px rgba(0,0,0,0.8); }
        .featured-button {
            background-color: white; color: black; padding: 10px 20px; border-radius: 20px;
            text-decoration: none; font-weight: bold; display: inline-block; transition: background-color 0.3s;
        }
        
        /* --- PRODUCT GRID SECTIONS --- */
        .product-grid-section { padding: 40px 0; }
        .product-grid-section h2 { font-size: 24px; font-weight: 600; margin-bottom: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .product-card { text-align: left; }
        .product-card img { width: 100%; height: auto; background-color: #f5f5f5; margin-bottom: 10px; }
        .product-info p { margin: 2px 0; }
        .product-name { font-weight: 600; line-height: 1.2; font-size: 16px; }
        .product-category { color: #707070; font-size: 14px; }
        .product-price { font-weight: bold; margin-top: 5px; }

        /* --- FOOTER (Giữ lại để đảm bảo style toàn trang) --- */
        .main-footer { background-color: #f5f5f5; color: #111111; padding-top: 40px; padding-bottom: 20px; }
        .footer-columns { display: flex; flex-wrap: wrap; justify-content: space-between; max-width: 1200px; margin: 0 auto; padding: 0 40px 40px; gap: 30px; }
        .footer-columns h4 { font-size: 16px; margin-bottom: 15px; color: #111111; font-weight: bold; }
        .footer-columns ul { list-style: none; padding: 0; margin: 0; }
        .footer-columns a, .country-selector { color: #707070; font-size: 14px; text-decoration: none; }
        .country-selector { font-weight: bold; display: flex; align-items: center; color: #111111; }
        .footer-bottom { display: flex; flex-wrap: wrap; justify-content: flex-start; align-items: center; max-width: 1200px; margin: 0 auto; padding: 15px 40px 0; border-top: 1px solid #e0e0e0; }
        .footer-bottom span { margin-right: 30px; font-size: 12px; color: #707070; }
        .footer-bottom a { color: #707070; margin-right: 20px; font-size: 12px; text-decoration: none; }
    </style>
</head>
<body>

    <div class="top-banner">
        <a href="#">Find a Store</a>
        <a href="#">Help</a>
        <div class="sign-in-box">
            <a href="admin/signup.php">Join Us</a>
            <a href="admin/login.php">Sign In</a>
        </div>
    </div>
    
    <header>
        <div class="logo">
            <img src="../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="PKD SHOP Logo">
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
    <main class="main-container">