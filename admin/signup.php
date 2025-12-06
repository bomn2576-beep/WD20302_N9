<?php
session_start();

// Xử lý đăng ký
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm"] ?? "";
    $ten = $_POST["ten"] ?? "";

    if ($password !== $confirm) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        // Lưu vào DB
        $pass_hash = password_hash($password, PASSWORD_DEFAULT); // mã hóa mật khẩu
        mysqli_query($conn, "INSERT INTO khachhang (ten, email, matkhau) VALUES ('$ten','$email','$pass_hash')");
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
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family: Arial, sans-serif;}
        body{background:#fff;}
        header{width:100%;background:white;padding:15px 40px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #eee;}
        header .logo img{width:50px;}
        nav{display:flex;gap:25px;}
        nav a{text-decoration:none;color:black;font-size:15px;}
        .top-links{display:flex;gap:20px;font-size:14px;}
        .top-links a{text-decoration:none;color:black;}
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
        footer{margin-top:80px;padding:40px;background:#f5f5f5;}
        .footer-grid{display:grid;grid-template-columns: repeat(3, 1fr);gap:30px;}
        .footer-grid h4{margin-bottom:12px;}
        .footer-grid a{display:block;margin:6px 0;text-decoration:none;color:#333;font-size:14px;}
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">
        <img src="" alt="logo">
    </div>

    <nav>
        <a href="#">New & Featured</a>
        <a href="#">Men</a>
        <a href="#">Women</a>
        <a href="#">Kids</a>
        <a href="#">Sale</a>
    </nav>

    <div class="top-links">
        <a href="#">Find a Store</a>
        <a href="#">Help</a>
        <a href="signup.php">Join Us</a>
        <a href="login.php">Sign In</a>
    </div>
</header>

<!-- FORM SIGNUP -->
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

<!-- FOOTER -->
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
