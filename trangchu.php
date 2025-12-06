<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<header class="header">
    <h1>Shop Giày Sneaker</h1>
</header>

<!-- BANNER -->
<section class="banner">
    <img src="images/banner1.jpg" alt="">
</section>

<!-- SẢN PHẨM -->
<section class="product-section">
    <h2>Sản phẩm nổi bật</h2>

    <div class="product-slider">
        <?php
        $result = $conn->query("SELECT * FROM products");

        while($row = $result->fetch_assoc()):
        ?>
        <div class="product-card">
            <img src="images/<?php echo $row['image']; ?>" alt="">
            <h3><?php echo $row['name']; ?></h3>
            <p class="price"><?php echo number_format($row['price']); ?>đ</p>
        </div>
        <?php endwhile; ?>
    </div>
</section>

</body>
</html>
