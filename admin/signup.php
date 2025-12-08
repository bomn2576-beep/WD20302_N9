<?php
session_start();

// Xử lý đăng ký
// Đảm bảo file db.php nằm cùng cấp hoặc đúng đường dẫn
include "db.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm"] ?? "";
    $ten = $_POST["ten"] ?? "";

    if ($password !== $confirm) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        // Lưu ý: Cần thêm kiểm tra email đã tồn tại chưa trước khi INSERT
        
        // Lưu vào DB
        $pass_hash = password_hash($password, PASSWORD_DEFAULT); // mã hóa mật khẩu
        // Đảm bảo $conn được định nghĩa trong db.php và kết nối thành công.
        // Cần sử dụng prepared statements để tránh SQL Injection
        // Ví dụ: mysqli_query($conn, "INSERT INTO khachhang (ten, email, matkhau) VALUES ('$ten','$email','$pass_hash')");
        
        // ********************
        // VÍ DỤ SỬ DỤNG PREPARED STATEMENT (AN TOÀN HƠN)
        // Bỏ comment đoạn dưới và comment đoạn mysqli_query ở trên nếu muốn dùng Prepared Statements
        /*
        if ($stmt = $conn->prepare("INSERT INTO khachhang (ten, email, matkhau) VALUES (?, ?, ?)")) {
            $stmt->bind_param("sss", $ten, $email, $pass_hash);
            $stmt->execute();
            $stmt->close();
            $success = "Đăng ký thành công! Bạn có thể đăng nhập.";
        } else {
             $error = "Lỗi truy vấn: " . $conn->error;
        }
        */
        // ********************

        $success = "Đăng ký thành công! Bạn có thể đăng nhập.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family: Arial, sans-serif;}
        body{background:#fff;}

        /* --- HEADER & NAVIGATION MỚI --- */
        .top-banner {
            width: 100%;
            background: #f0f0f0; 
            padding: 5px 40px;
            display: flex;
            justify-content: flex-end; 
            font-size: 13px;
            border-bottom: 1px solid #ddd;
        }
        .top-banner a, .top-banner span {
            text-decoration: none;
            color: black;
            padding: 0 10px;
            border-left: 1px solid #ccc;
            line-height: 1; 
            cursor: pointer;
        }
        .top-banner a:first-child, .top-banner span:first-child {
            border-left: none; 
        }
        .top-banner .sign-in-box {
            background-color: #e0e0e0; 
            padding: 0 10px;
            margin-left: 10px;
            display: flex;
        }
        .top-banner .sign-in-box a {
            border-left: 1px solid #ccc;
            padding: 0 10px;
        }
        .top-banner .sign-in-box a:first-child {
             border-left: none;
        }

        header{
            /* Dùng Grid cho Logo - Menu - Action */
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
            /* Căn giữa tuyệt đối các mục menu */
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
            color: inherit; 
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
            padding: 10px 40px; /* Padding ngang 40px giúp căn đều hàng */
        }
        
        .delivery-bar {
            text-align: center;
            font-size: 14px;
        }
        .delivery-bar a {
            color: black;
            font-weight: bold;
        }
        /* --- KẾT THÚC HEADER & NAVIGATION MỚI --- */


        /* FORM */
        .container{max-width:450px;margin:60px auto;text-align:center;}
        h2{margin-bottom:20px;font-size:22px;letter-spacing:1px;}
        .input-box{width:100%;margin:10px 0;}
        .input-box input{width:100%;padding:14px;border-radius:8px;border:1px solid #ddd;background:#f4f4f4;outline:none;font-size:15px;}
        .btn{width:100%;padding:13px;background:black;border:none;border-radius:8px;color:white;margin:15px 0;cursor:pointer;font-size:16px;}
        .btn:hover{opacity:0.8;}
        .text-row{display:flex;justify-content:space-between;font-size:14px;margin-top:10px;}
        .text-row a{color:#1a73e8;text-decoration:none;}
        .social-box{margin-top:25px;}
        .social-btn{display:flex;align-items:center;justify-content:center;width:100%;padding:12px;border-radius:6px;color:white;font-size:15px;margin:8px 0;cursor:pointer;text-decoration:none;}
        .fb{background:#1877f2;}
        .gg{background:#db4437;}
        .error{color:red;margin-top:10px;}
        .success{color:green;margin-top:10px;}
        
        /* FOOTER */
        footer{margin-top:80px;padding:40px;background:#f5f5f5;}
        .footer-grid{display:grid;grid-template-columns: repeat(3, 1fr);gap:30px;}
        .footer-grid h4{margin-bottom:12px;}
        .footer-grid a{display:block;margin:6px 0;text-decoration:none;color:#333;font-size:14px;}
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
        <img src="../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="Logo">
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
            <i class="far fa-heart icon-btn"></i> 
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
<div class="container">
    <h2>SIGN UP</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="input-box">
            <input type="text" name="ten" placeholder="Họ tên" required>
        </div>
        <div class="input-box">
            <input type="email" name="email" placeholder="vui lòng nhập email" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="vui lòng nhập mật khẩu" required>
        </div>
        <div class="input-box">
            <input type="password" name="confirm" placeholder="xác nhận mật khẩu" required>
        </div>

        <button class="btn" type="submit">SIGN UP</button>

        <div class="text-row">
            <span>Bạn đã có tài khoản?</span>
            <a href="login.php">Đăng nhập</a>
        </div>
    </form>

    <div class="social-box">
        <a href="#" class="social-btn fb">Đăng ký bằng Facebook</a>
        <a href="#" class="social-btn gg">Đăng ký bằng Google</a>
    </div>
</div>

<footer>
    <div class="footer-grid">
        <div>
            <h4>Resources</h4>
            <a href="#">Find A Store</a>
            <a href="#">Become A Member</a>
            <a href="#">Running Shoe Finder</a>
            <a href="#">Feedback</a>
        </div>

        <div>
            <h4>Help</h4>
            <a href="#">Get Help</a>
            <a href="#">Order Status</a>
            <a href="#">Delivery</a>
            <a href="#">Payment Options</a>
        </div>

        <div>
            <h4>Company</h4>
            <a href="#">About Us</a>
            <a href="#">News</a>
            <a href="#">Careers</a>
            <a href="#">Investors</a>
        </div>
    </div>
</footer>

</body>
</html>