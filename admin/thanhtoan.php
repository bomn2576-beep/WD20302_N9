<?php
session_start();

// Giỏ hàng hiện tại
$cart_items = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family: Arial, sans-serif;}
        body{background:#fff;display:flex;flex-direction:column;min-height:100vh;}

        /* TOP BANNER */
        .top-banner{width:100%;background:#f0f0f0;padding:5px 40px;display:flex;justify-content:flex-end;font-size:13px;border-bottom:1px solid #ddd;}
        .top-banner a{text-decoration:none;color:black;padding:0 10px;border-left:1px solid #ccc;}
        .top-banner a:first-child{border-left:none;}

        /* HEADER */
        header{display:grid;grid-template-columns:auto 1fr auto;align-items:center;padding:15px 40px;}
        .logo img{width:50px;}
        nav{display:flex;gap:25px;justify-content:center;}
        nav a{text-decoration:none;color:black;font-size:15px;font-weight:500;}
        nav a:hover{border-bottom:2px solid black;}
        .action-icons{display:flex;align-items:center;gap:15px;}
        .action-icons a{text-decoration:none;color:black;}
        .action-icons .search-box{display:flex;align-items:center;background:#f5f5f5;border-radius:20px;padding:5px 15px;}
        .search-box input{border:none;background:none;outline:none;padding:5px;font-size:14px;width:150px;}

        /* DELIVERY BAR */
        .delivery-bar-wrapper{width:100%;background:#f0f0f0;padding:10px 40px;}
        .delivery-bar{text-align:center;font-size:14px;}

        /* THANH TOÁN */
        .container{max-width:800px;margin:50px auto;padding:20px;background:#fff;border-radius:8px;flex-grow:1;}
        h2{text-align:center;margin-bottom:20px;}
        table{width:100%;border-collapse:collapse;margin-bottom:20px;}
        table th, table td{border:1px solid #ccc;padding:10px;text-align:center;}
        .total{text-align:right;font-weight:bold;margin-bottom:20px;}
        .qr{text-align:center;margin-top:20px;}
        .qr img{max-width:200px;}
        .btn-back{display:inline-block;padding:10px 20px;background:#007bff;color:#fff;border-radius:5px;text-decoration:none;margin-bottom:20px;}

        /* FOOTER */
        footer{background:#f5f5f5;padding:50px 20px;margin-top:auto;width:100%;}
        .footer-container{max-width:1300px;margin:auto;display:flex;flex-wrap:wrap;justify-content:space-between;gap:40px;align-items:flex-start;}
        .footer-col{flex:1 1 200px;min-width:180px;margin-bottom:20px;}
        .footer-col h4{font-size:18px;margin-bottom:15px;color:#000;}
        .footer-col a{display:block;color:#333;text-decoration:none;font-size:14px;margin-bottom:8px;opacity:0.8;transition:opacity 0.3s;}
        .footer-col a:hover{opacity:1;}
        .footer-lang{display:flex;align-items:center;gap:8px;font-size:16px;color:#333;margin-top:20px;}
        .footer-lang i{font-size:18px;line-height:1;}
    </style>
</head>
<body>

<!-- TOP BANNER -->
<div class="top-banner">
    <a href="#">Find a Store</a>
    <a href="#">Help</a>
    <a href="../admin/signup.php">Join Us</a>
    <a href="../admin/login.php">Sign In</a>
</div>

<!-- HEADER -->
<header>
    <div class="logo">
        <a href="">
            <img src="../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="PDK STORE Logo">
        </a>
    </div>

    <nav>
        <a href="">New & Featured</a>
        <a href="../products_men.php">Men</a>
        <a href="../products_women.php">Women</a>
        <a href="../products_kid.php">Kids</a>
        <a href="#">Sale</a>
    </nav>

    <div class="action-icons">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search">
        </div>

        <a href="../admin/favorites.php"><i class="far fa-heart icon-btn"></i></a>
        <a href="../admin/cart.php"><i class="fas fa-shopping-bag icon-btn"></i></a>
    </div>
</header>

<!-- DELIVERY BAR -->
<div class="delivery-bar-wrapper">
    <div class="delivery-bar">
        Free Standard Delivery & 30-Day Free Returns | 
        <a href="../admin/login.php">Join Now</a> | 
        <a href="#">View Detail</a>
    </div>
</div>

<!-- THANH TOÁN -->
<div class="container">
    <h2>Thanh Toán</h2>

    <?php if(empty($cart_items)): ?>
        <p>Giỏ hàng của bạn đang trống.</p>
        <a href="../index.php" class="btn-back">Quay lại mua sắm</a>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Hình</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart_items as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="50"></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= number_format($item['price']) ?>₫</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($subtotal) ?>₫</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">Tổng: <?= number_format($total) ?>₫</div>

        <div class="qr">
            <p>Quét QR để thanh toán:</p>
            <img src="../img/qr.jpg" alt="QR Payment">
        </div>
    <?php endif; ?>
</div>

<!-- FOOTER -->
<footer>
    <div class="footer-container">

        <div class="footer-col">
            <h4>Resources</h4>
            <a href="#">Find A Store</a>
            <a href="#">Become A Member</a>
            <a href="#">Running Shoe Finder</a>
            <a href="#">PKD Coaching</a>
            <a href="#">Send Us Feedback</a>
        </div>

        <div class="footer-col">
            <h4>Help</h4>
            <a href="#">Get Help</a>
            <a href="#">Order Status</a>
            <a href="#">Delivery</a>
            <a href="#">Returns</a>
            <a href="#">Payment Options</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="footer-col">
            <h4>Company</h4>
            <a href="#">About Nike</a>
            <a href="#">News</a>
            <a href="#">Careers</a>
            <a href="#">Investors</a>
            <a href="#">Sustainability</a>
            <a href="#">Report a Concern</a>
        </div>

        <div class="footer-lang">
            <i class="fa-solid fa-globe"></i> Vietnam
        </div>

    </div>
</footer>

</body>
</html>
