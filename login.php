<?php
session_start();

// Xử lý đăng nhập (demo)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($email === "admin@gmail.com" && $password === "123456") {
        $_SESSION["user"] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email hoặc mật khẩu không đúng!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }
        body{
            background:#fff;
        }
        .container{
            max-width:450px;
            margin:80px auto;
            text-align:center;
        }
        h2{
            margin-bottom:20px;
            font-size:22px;
            letter-spacing:1px;
        }
        .input-box{
            width:100%;
            margin:10px 0;
        }
        .input-box input{
            width:100%;
            padding:14px;
            border-radius:8px;
            border:1px solid #ddd;
            background:#f4f4f4;
            outline:none;
            font-size:15px;
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
        .btn:hover{
            opacity:0.8;
        }
        .text-row{
            display:flex;
            justify-content:space-between;
            font-size:14px;
            margin-top:10px;
        }
        .text-row a{
            color:#1a73e8;
            text-decoration:none;
        }
        .social-box{
            margin-top:25px;
        }
        .social-btn{
            display:flex;
            align-items:center;
            justify-content:center;
            width:100%;
            padding:12px;
            border-radius:6px;
            color:white;
            font-size:15px;
            margin:8px 0;
            cursor:pointer;
            text-decoration:none;
        }
        .fb{
            background:#1877f2;
        }
        .gg{
            background:#db4437;
        }
        .error{
            color:red;
            margin-top:10px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>SIGN IN</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="input-box">
            <input type="email" name="email" placeholder="vui lòng nhập email" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="vui lòng nhập mật khẩu" required>
        </div>

        <button class="btn" type="submit">SIGN IN</button>

        <div class="text-row">
            <span>Bạn chưa có tài khoản?</span>
            <a href="#">Đăng ký ngay</a>
        </div>

        <div class="text-row">
            <span>Bạn quên mật khẩu?</span>
            <a href="#">Khôi phục mật khẩu</a>
        </div>
    </form>

    <div class="social-box">
        <a href="#" class="social-btn fb">Đăng nhập với Facebook</a>
        <a href="#" class="social-btn gg">Đăng nhập với Google</a>
    </div>
</div>

</body>
</html>
