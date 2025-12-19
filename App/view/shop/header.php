<?php 
$base_url = $GLOBALS['base_url_path']; 
?>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/css/nike_style.css">

    <style>
        :root {
            --nike-black: #111111;
            --nike-gray: #707072;
            --nike-light-gray: #f5f5f5;
            --nike-border: #e5e5e5;
        }

        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            color: var(--nike-black); 
            margin: 0;
        }

        /* 1. Utility Bar - Thanh phụ trên cùng */
        .utility-bar { 
            background-color: var(--nike-light-gray); 
            height: 36px; 
            font-size: 12px; 
            padding: 0 48px !important; 
        }
        .utility-bar a { 
            text-decoration: none; 
            color: var(--nike-black); 
            font-weight: 500; 
            transition: opacity 0.2s;
        }
        .utility-bar a:hover { opacity: 0.6; }
        .separator { color: #ccc; padding: 0 8px; }

        /* 2. Main Header - Thanh điều hướng chính */
        .main-header { 
            height: 60px; 
            padding: 0 48px !important; 
            background-color: #fff; 
            z-index: 1000; 
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo */
        .header-logo img {
            transition: transform 0.2s;
        }
        .header-logo img:hover { transform: scale(1.05); }

        /* Menu chính giữa */
        .header-menu {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .header-menu a { 
            text-decoration: none; 
            color: var(--nike-black); 
            font-weight: 600; 
            padding: 0 15px; 
            font-size: 16px; 
            line-height: 60px; 
            display: inline-block; 
            border-bottom: 2px solid transparent; 
            transition: all 0.2s ease; 
        }
        .header-menu a:hover { border-bottom: 2px solid var(--nike-black); }

        /* Công cụ bên phải (Search, Wishlist, Cart) */
        .search-container { 
            background-color: var(--nike-light-gray); 
            border-radius: 100px; 
            padding: 6px 16px; 
            display: flex; 
            align-items: center; 
            transition: background 0.3s;
        }
        .search-container:hover { background-color: #ebebeb; }
        .search-container input { 
            border: none; 
            background: transparent; 
            outline: none; 
            padding-left: 10px; 
            width: 140px; 
            font-size: 14px;
        }
        
        .tool-icon { 
            color: var(--nike-black); 
            text-decoration: none; 
            position: relative; 
            padding: 5px;
            transition: background 0.2s;
            border-radius: 50%;
        }
        .tool-icon:hover { background-color: var(--nike-light-gray); }

        /* 3. Promo Bar - Thanh khuyến mãi */
        .promo-bar { 
            background-color: var(--nike-light-gray); 
            border-bottom: 1px solid var(--nike-border); 
            padding: 10px 0; 
        }
        .promo-bar p { font-size: 14px; margin: 0; }
        .promo-bar a { 
            font-size: 12px; 
            color: var(--nike-black); 
            font-weight: 600;
        }

        /* User Greeting */
        .user-greeting { font-weight: 600; font-size: 12px; }
    </style>
</head>

<div class="utility-bar d-none d-md-flex justify-content-between align-items-center">
    <div class="utility-left">
        <a href="<?= $base_url ?>index.php?page=home">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/37/Jumpman_logo.svg/1200px-Jumpman_logo.svg.png" width="18" alt="Jordan">
        </a>
    </div>
    <div class="utility-right d-flex align-items-center">
        <a href="#">Find a Store</a> <span class="separator">|</span>
        <a href="#">Help</a> <span class="separator">|</span>

        <?php if (isset($_SESSION['user_name'])): ?>
            <span class="user-greeting">Hi, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
            <span class="separator">|</span>
            <a href="<?= $base_url ?>index.php?page=logout">Sign Out</a>
        <?php else: ?>
            <a href="<?= $base_url ?>index.php?page=register">Join Us</a> <span class="separator">|</span>
            <a href="<?= $base_url ?>index.php?page=login">Sign In</a>
        <?php endif; ?>
    </div>
</div>

<nav class="main-header sticky-top">
    <div class="header-logo">
        <a href="<?= $base_url ?>index.php?page=home">
            <img src="<?= $base_url ?>App/view/shop/img/logo.jpg" width="60" alt="Nike Logo">
        </a>
    </div>

    <div class="header-menu d-none d-lg-flex">
        <a href="<?= $base_url ?>index.php?page=category">New & Featured</a>
        <a href="<?= $base_url ?>index.php?page=category&gender=men">Men</a>
        <a href="<?= $base_url ?>index.php?page=category&gender=women">Women</a>
        <a href="<?= $base_url ?>index.php?page=category&gender=kids">Kids</a>
        <a href="<?= $base_url ?>index.php?page=sale">Sale</a>
    </div>

    <div class="header-tools d-flex align-items-center gap-2">
        <form action="<?= $base_url ?>index.php" method="GET" class="search-container d-none d-md-flex">
            <input type="hidden" name="page" value="search">
            <i class="bi bi-search"></i>
            <input type="text" name="q" placeholder="Search">
        </form>
        <a href="<?= $base_url ?>index.php?page=wishlist" class="tool-icon"><i class="bi bi-heart fs-5"></i></a>
        <a href="<?= $base_url ?>index.php?page=cart" class="tool-icon">
            <a href="<?= $base_url ?>index.php?page=cart" class="tool-icon">
    <i class="bi bi-bag fs-4"></i>
    <?php if(!empty($_SESSION['cart'])): ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" style="font-size: 10px;">
            <?= array_sum($_SESSION['cart']) ?> 
        </span>
    <?php endif; ?>
</a>
    </div>
</nav>

<div class="promo-bar text-center">
    <p class="fw-bold">Free Standard Delivery & 30-Day Free Returns</p>
    <div class="d-flex justify-content-center gap-3">
        <a href="<?= $base_url ?>index.php?page=register" class="text-decoration-underline">Join Now</a>
        <a href="#" class="text-decoration-underline">View Details</a>
    </div>
</div>