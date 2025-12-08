<?php
session_start();
include "../config.php";

$error = "";
$success = "";

// Xử lý form khôi phục mật khẩu
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");

    if (empty($email)) {
        $error = "Vui lòng nhập email!";
    } else {
        $stmt_check = $conn->prepare("SELECT id FROM khachhang WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Email tồn tại, hiển thị thông báo thành công
            $success = "Chúng tôi đã gửi link khôi phục mật khẩu đến email của bạn!";
        } else {
            $error = "Email không tồn tại trong hệ thống!";
        }

        $stmt_check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khôi phục mật khẩu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }
        body{
            background:#fff;
            display: flex; 
            flex-direction: column;
            min-height: 100vh;
        }

        /* FIX ICON & Z-INDEX GIỐNG TRANG LOGIN */
        header, .top-banner {
            position: relative;
            z-index: 1000;
        }
        .icon-btn {
            font-size: 20px;
            cursor: pointer;
            color: black;
        }

        /* HEADER BANNER */
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
        }
        .top-banner a:first-child {
            border-left: none; 
        }

        header{
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            padding: 15px 40px; 
        }

        .logo img {
            width: 50px;
        }

        nav{
            display:flex;
            gap:25px;
            justify-content:center;
        }
        nav a{
            text-decoration:none;
            color:black;
            font-size:15px;
            font-weight: 500;
        }
        nav a:hover{
            border-bottom:2px solid black;
        }

        .action-icons{
            display:flex;
            align-items:center;
            gap: 15px;
        }
        .action-icons a{
            text-decoration:none;
            color:black;
        }

        .action-icons .search-box{
            display:flex;
            align-items:center;
            background:#f5f5f5;
            border-radius:20px;
            padding:5px 15px;
        }

        .search-box input{
            border:none;
            background:none;
            outline:none;
            padding:5px;
            font-size:14px;
            width: 150px;
        }

        /* DELIVERY BAR */
        .delivery-bar-wrapper {
            width: 100%;
            background: #f0f0f0;
            padding: 10px 40px;
        }
        .delivery-bar {
            text-align: center;
            font-size: 14px;
        }

        /* FORM */
        .container{
            max-width:450px;
            margin:60px auto;
            text-align:center;
            flex-grow: 1;
        }
        .input-box input{
            width:100%;
            padding:14px;
            border-radius:8px;
            border:1px solid #ddd;
            background:#f4f4f4;
            margin:10px 0;
        }

        .btn{
            width:100%;
            padding:13px;
            background:black;
            border:none;
            border-radius:8px;
            color:white;
            margin:15px 0;
            cursor:pointer;
            font-size:16px;
        }

        .text-row{
            margin-top: 10px;
            font-size: 14px;
        }
        .text-row a{
            color:#1a73e8;
            text-decoration:none;
        }

        /* FOOTER FIXED NÂNG CAO */
        footer{
            background:#f5f5f5;
            padding:50px 20px;
            margin-top: auto;
            width:100%;
            font-family: Arial, sans-serif;
        }

        .footer-container{
            max-width:1300px;
            margin:auto;
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            gap:40px;
            padding:0 20px;
            align-items:flex-start; /* canh tất cả cột trên cùng */
        }

        .footer-col{
            flex:1 1 200px;
            min-width:180px;
            margin-bottom:20px;
        }

        .footer-col h4{
            font-size:18px;
            margin-bottom:15px;
            color:#000;
        }

        .footer-col a{
            display:block;
            color:#333;
            text-decoration:none;
            font-size:14px;
            margin-bottom:8px;
            opacity:0.8;
            transition:opacity 0.3s;
        }

        .footer-col a:hover{
            opacity:1;
        }

        /* PHẦN VIỆT NAM */
        .footer-lang{
            display:flex;
            align-items:center;
            gap:8px;
            font-size:16px;
            color:#333;
            margin-top:20px;
        }

        .footer-lang i{
            font-size:18px;
            line-height:1;
        }
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

<!-- FORM KHÔI PHỤC -->
<div class="container">
    <h2>Khôi phục mật khẩu</h2>
    <p>Nhập email để nhận link khôi phục mật khẩu.</p>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green; font-weight:bold;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="input-box">
            <input type="email" name="email" placeholder="Nhập email của bạn" required>
        </div>
        <button class="btn" type="submit">Gửi yêu cầu</button>

        <div class="text-row">
            <span>Bạn đã có tài khoản?</span>
            <a href="../admin/login.php">Đăng nhập</a>
        </div>
    </form>
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
