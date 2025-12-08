<?php
// --- LỆNH KÉO DỮ LIỆU TỪ data.php ---
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKD Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <img src="img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="">
        </a>
        <ul class="nav-links">
            <li><a href="#">New & Featured</a></li>
            <li><a href="#">Men</a></li>
            <li><a href="#">Women</a></li>
            <li><a href="#">Kids</a></li>
            <li><a href="#">Sale</a></li>
        </ul>
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
        Free Standard Delivery & 30-Day Free Returns | <a href="#">Join Now</a> | <a href="#">View Detail</a>
    </div>

    <section class="hero">
        <div class="hero-content">
            <h1>Just Do It</h1>
            <p>Your daily dose of greatness.</p>
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
                    <li>About PKD</li>
                    <li>News</li>
                    <li>Careers</li>
                    <li>Investors</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© 2025 PKD, Inc. All Rights Reserved</div>
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