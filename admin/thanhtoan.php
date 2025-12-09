<?php
session_start();

// Mặc định, trạng thái thanh toán là FALSE
$checkout_complete = false;

// 1. KIỂM TRA VÀ XỬ LÝ THANH TOÁN
if (isset($_POST['checkout'])) {
    
    // --- LƯU Ý QUAN TRỌNG: Đây là nơi bạn sẽ gọi hàm lưu đơn hàng vào database
    // Dữ liệu khách hàng đã được gửi trong $_POST (name, phone, address_detail,...)
    // Giỏ hàng nằm trong $_SESSION['cart']
    
    // 2. ĐÁNH DẤU HOÀN TẤT VÀ XÓA GIỎ HÀNG
    // Đặt biến trạng thái để hiển thị thông báo cảm ơn
    $_SESSION['checkout_complete'] = true;
    
    // Xóa giỏ hàng khỏi Session
    unset($_SESSION['cart']);
    
    // CHUYỂN HƯỚNG SANG CHÍNH TRANG NÀY (Post/Redirect/Get Pattern)
    // Đây là bước BẮT BUỘC để tránh lỗi F5/Reload tạo đơn hàng trùng lặp.
    // Việc này cũng đảm bảo các ô input sẽ bị xóa hết sau khi submit.
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// 3. KIỂM TRA TRẠNG THÁI HIỂN THỊ THÔNG BÁO
if (isset($_SESSION['checkout_complete']) && $_SESSION['checkout_complete'] === true) {
    $checkout_complete = true;
    // Sau khi hiển thị thông báo, xóa biến trạng thái để lần truy cập sau không hiện nữa
    unset($_SESSION['checkout_complete']);
}


// Giỏ hàng hiện tại (sẽ trống nếu vừa hoàn tất)
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

        /* THANH TOÁN & CONTAINER */
        .container{max-width:1000px;margin:50px auto;padding:20px;background:#fff;border-radius:8px;flex-grow:1;display:flex;gap:30px;flex-wrap: wrap;} /* Thêm flex-wrap để responsive tốt hơn */
        h2{text-align:center;margin-bottom:20px;}
        
        .cart-summary, .customer-info{flex:1 1 400px;} /* Điều chỉnh flex basis */

        table{width:100%;border-collapse:collapse;margin-bottom:20px;}
        table th, table td{border:1px solid #ccc;padding:10px;text-align:center;font-size:14px;}
        .total{text-align:right;font-weight:bold;font-size:18px;margin-bottom:20px;padding-right:10px;}
        .btn-back{display:inline-block;padding:10px 20px;background:#007bff;color:#fff;border-radius:5px;text-decoration:none;margin-bottom:20px;}
        
        /* Customer Info Form */
        .customer-info h3{margin-bottom:15px;text-align:center;}
        .form-group{margin-bottom:15px;}
        .form-group label{display:block;margin-bottom:5px;font-weight:bold;font-size:14px;}
        .form-group input, .form-group textarea, .form-group select{
            width:100%;padding:10px;border:1px solid #ccc;border-radius:5px;font-size:14px;
        }
        .btn-checkout{
            width:100%;padding:15px;background:#000;color:#fff;border:none;border-radius:5px;
            font-size:18px;font-weight:bold;cursor:pointer;margin-top:20px;transition:background 0.3s;
        }
        .btn-checkout:hover{background:#333;}
        
        /* Thank You Message Style */
        .thank-you-message {
            width: 100%;
            padding: 40px;
            text-align: center;
            border: 1px solid #d4edda;
            background-color: #f7fff7;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .thank-you-message h2{
            color: #28a745;
            font-size: 28px;
        }
        .thank-you-message p{
            font-size: 16px;
            margin-top: 15px;
        }
        .thank-you-message a{
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }


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

<div class="top-banner">
    <a href="#">Find a Store</a>
    <a href="#">Help</a>
    <a href="../admin/signup.php">Join Us</a>
    <a href="../admin/login.php">Sign In</a>
</div>

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

<div class="delivery-bar-wrapper">
    <div class="delivery-bar">
        Free Standard Delivery & 30-Day Free Returns | 
        <a href="../admin/login.php">Join Now</a> | 
        <a href="#">View Detail</a>
    </div>
</div>

<div class="container">
    
    <?php if ($checkout_complete): ?>
        <div class="thank-you-message">
            <h2>🎉 Đặt hàng thành công!</h2>
            <p>Cảm ơn quý khách đã tin tưởng và đặt hàng tại PDK STORE. Chúng tôi sẽ xử lý đơn hàng và liên hệ với quý khách sớm nhất.</p>
            <a href="../Trang Chủ/index.php">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="customer-info">
            <h2>Thông Tin Khách Hàng & Giao Hàng</h2>
            <form action="" method="POST"> 
                <h3>Thông tin khách hàng</h3>
                <div class="form-group">
                    <label for="name">Họ và Tên (*)</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số Điện Thoại (*)</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>

                <h3>Địa Chỉ Giao Hàng</h3>
                <div class="form-group">
                    <label for="province">Tỉnh/Thành phố (*)</label>
                    <input type="text" id="province" name="province" required placeholder="Ví dụ: TP. Hồ Chí Minh">
                </div>
                <div class="form-group">
                    <label for="district">Quận/Huyện (*)</label>
                    <input type="text" id="district" name="district" required placeholder="Ví dụ: Quận 1">
                </div>
                <div class="form-group">
                    <label for="ward">Phường/Xã (*)</label>
                    <input type="text" id="ward" name="ward" required placeholder="Ví dụ: Phường Bến Nghé">
                </div>
                <div class="form-group">
                    <label for="address_detail">Địa chỉ chi tiết (*)</label>
                    <input type="text" id="address_detail" name="address_detail" required placeholder="Số nhà, tên đường/tòa nhà">
                </div>
                <div class="form-group">
                    <label for="notes">Ghi chú (Tùy chọn)</label>
                    <textarea id="notes" name="notes" rows="3"></textarea>
                </div>

                <?php if(empty($cart_items)): ?>
                    <p>Giỏ hàng của bạn đang trống. Vui lòng quay lại mua sắm.</p>
                    <a href="../Trang Chủ/index.php" class="btn-back">Quay lại mua sắm</a>
                <?php else: ?>
                    <button type="submit" class="btn-checkout" name="checkout">HOÀN TẤT ĐẶT HÀNG</button>
                <?php endif; ?>
            </form>
        </div>

        <div class="cart-summary">
            <h2>Tóm Tắt Đơn Hàng</h2>
            
            <?php if(empty($cart_items)): ?>
                <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Hình</th>
                            <th>Tên SP</th>
                            <th>Giá</th>
                            <th>SL</th>
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

                <div class="total">Tổng cộng: <?= number_format($total) ?>₫</div>
                
                <a href="../admin/cart.php" class="btn-back">Quay lại giỏ hàng</a>
                
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

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