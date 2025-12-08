<?php
// --- LỆNH KÉO DỮ LIỆU TỪ data.php ---
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="top-bar-wrapper">
        <div class="top-bar-links-right">
            <a href="#">Find a Store</a>
            <a href="#">Help</a>
            <a href="#">Join Us</a>
            <a href="#">Sign In</a>
        </div>
    </div>

    <header>
        <a href="index.php" class="logo">
            <svg viewBox="0 0 24 24" role="img" width="60px" height="60px" fill="none"><path fill="currentColor" fill-rule="evenodd" d="M21 8.719L7.836 14.303C6.74 14.768 5.818 15 5.075 15c-.836 0-1.445-.295-1.819-.884-.485-.76-.273-1.982.559-3.272.494-.754 1.122-1.446 1.734-2.108-.144.234-1.415 2.349-.025 3.345.275.2.666.298 1.147.298.386 0 .829-.063 1.316-.19L21 8.719z" clip-rule="evenodd"></path></svg>
        </a>
        <ul class="nav-links">
            <li><a href="#">New & Featured</a></li>
            <li><a href="#">Men</a></li>
            <li><a href="#">Women</a></li>
            <li><a href="#">Kids</a></li>
            <li><a href="#">Sale</a></li>
        </ul>
        <div class="nav-right">
            <div class="search-box">
                <span class="search-icon">⌕</span>
                <input type="text" placeholder="Search">
            </div>
            <span class="icon-btn">♡</span>
            <span class="icon-btn">👜</span>
        </div>
    </header>

    <div class="delivery-bar-wrapper">
        Free Standard Delivery & 30-Day Free Returns | <a href="#">Join Now</a> | <a href="#">View Detail</a>
    </div>

    <section class="hero">
        <div class="hero-content">
            <h1>Just Do It</h1>
            <p>Your daily dose of greatness.</p>
            <button class="btn-white">Shop Now</button>
        </div>
    </section>

<section class="section-padding">
        <h2 class="section-title">Featured</h2>
        <div class="featured-grid">
            <?php foreach($featured as $item): ?>
            <div class="featured-card">
                <img src="<?php echo $item['image_url']; ?>" alt="Featured">
                <div class="card-overlay">
                    <div class="card-title"><?php echo $item['title']; ?></div>
                    <div class="card-desc"><?php echo $item['description']; ?></div>
                    <button class="btn-white"><?php echo $item['button_text']; ?></button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="slider-container">
        <h2 class="section-title">Colour of the Season: Burgundy Brown</h2>
        <div class="product-list">
            <?php foreach($season_products as $prod): ?>
            <div class="product-card">
                <div class="product-img">
                    <img src="<?php echo $prod['image_url']; ?>" alt="Product">
                </div>
                <div class="p-info">
                    <div class="p-name"><?php echo $prod['name']; ?></div>
                    <div class="p-cat"><?php echo $prod['category']; ?></div>
                    <div class="p-price"><?php echo number_format($prod['price'], 0, ',', '.') . '₫'; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="slider-container">
        <h2 class="section-title">Shop by Icons</h2>
        <div class="product-list">
            <?php foreach($icon_products as $prod): ?>
            <div class="product-card">
                <div class="product-img">
                    <img src="<?php echo $prod['image_url']; ?>" alt="Product">
                </div>
                <div class="p-info">
                    <div class="p-name"><?php echo $prod['name']; ?></div>
                    <div class="p-cat"><?php echo $prod['category']; ?></div>
                    <div class="p-price"><?php echo number_format($prod['price'], 0, ',', '.') . '₫'; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Resources</h4>
                <ul>
                    <li>Find A Store</li>
                    <li>Become A Member</li>
                    <li>Send Us Feedback</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Help</h4>
                <ul>
                    <li>Get Help</li>
                    <li>Order Status</li>
                    <li>Delivery</li>
                    <li>Returns</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li>About Nike</li>
                    <li>News</li>
                    <li>Careers</li>
                    <li>Investors</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© 2024 Nike, Inc. All Rights Reserved</div>
            <div class="footer-links">
                <span>Guides</span>
                <span>Terms of Sale</span>
                <span>Terms of Use</span>
                <span>Privacy Policy</span>
            </div>
        </div>
    </footer>

</body>
</html>