<?php
session_start();
include "../config.php"; // file kết nối DB

$error = "";

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $error = "Vui lòng nhập email và mật khẩu!";
    } else {
        // Lấy thông tin user từ DB
        $stmt = $conn->prepare("SELECT matkhau FROM khachhang WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hash);
            $stmt->fetch();

            // So sánh mật khẩu
            if (password_verify($password, $hash)) {
                $_SESSION['user_name'] = $row['ten'];   // Lấy tên người dùng để hiển thị ở header
$_SESSION['user_id']   = $row['id'];    // (Khuyến khích)

                $_SESSION["user"] = $email; // lưu session
                header("Location:../Trang Chủ/index.php "); // chuyển sang index.php
                exit;
            } else {
                $error = "Mật khẩu không đúng!";
            }
        } else {
            $error = "Email không tồn tại!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}
body{
    background:#fff;
}

/* FIX Z-INDEX để không bị đè icon cart & favorite */
header, .top-banner {
    position: relative;
    z-index: 1000;
}

/* =================== TOP BANNER ==================== */
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
}
.top-banner a:first-child {
    border-left:none;
}
.top-banner .sign-in-box {
    background-color: #e0e0e0;
    padding: 0 10px;
    margin-left: 10px;
    display: flex;
}
.top-banner .sign-in-box a:first-child {
    border-left:none;
}

/* =================== HEADER ==================== */
header{
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    padding: 15px 40px;
    background:white;
    width:100%;
}

.logo img {
    width: 50px;
    height: auto;
}

nav{
    display:flex;
    gap:25px;
    justify-content: center;
}
nav a{
    text-decoration:none;
    color:black;
    font-size:15px;
    font-weight: 500;
}
nav a:hover {
    border-bottom: 2px solid black;
}

/* ACTION ICONS */
.action-icons{
    display:flex;
    align-items:center;
    gap: 15px;
}
.action-icons a{
    text-decoration:none;
    color:black;
}
.action-icons .icon-btn{
    font-size:20px;
    cursor:pointer;
}

/* SEARCH BOX */
.search-box{
    display:flex;
    align-items:center;
    background:#f5f5f5;
    padding:5px 15px;
    border-radius:20px;
}
.search-box input{
    border:none;
    background:none;
    outline:none;
    padding-left:8px;
}

/* =================== DELIVERY BAR ==================== */
.delivery-bar-wrapper {
    width: 100%;
    background: #f0f0f0;
    padding: 10px 40px;
}
.delivery-bar {
    text-align: center;
    font-size: 14px;
}
.delivery-bar a {
    color: black;
    font-weight: bold;
}

/* =================== LOGIN FORM ==================== */
.container{
    max-width:450px;
    margin:60px auto;
    text-align:center;
}
h2{
    font-size:22px;
    margin-bottom:20px;
}
.input-box input{
    width:100%;
    padding:14px;
    margin:10px 0;
    border-radius:8px;
    background:#f4f4f4;
    border:1px solid #ddd;
}
.btn{
    width:100%;
    padding:13px;
    margin-top:10px;
    background:black;
    color:white;
    border:none;
    border-radius:8px;
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
.error{
    color:red;
    margin-top:10px;
}

/* =================== FOOTER (ĐÃ FIX) ==================== */
footer{
    background:#f5f5f5;
    margin-top:80px;
    padding:50px 40px;
}

.footer-container{
    display:grid;
    grid-template-columns: repeat(3, 1fr) auto;
    gap:40px;
}

.footer-col h4{
    font-size:16px;
    margin-bottom:12px;
    font-weight:bold;
}

.footer-col a{
    display:block;
    text-decoration:none;
    color:#333;
    font-size:14px;
    margin:6px 0;
}

.footer-lang{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:14px;
}
.footer-lang i{
    font-size:18px;
}
</style>
</head>
<body>

<!-- TOP BANNER -->
<div class="top-banner">
    <a href="#">Find a Store</a>
    <a href="#">Help</a>
    <a href="signup.php">Join Us</a>

    <div class="sign-in-box">
        <a href="login.php">Sign In</a>
    </div>
</div>

<!-- HEADER -->
<header>
    <div class="logo">
        <img src="../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="PDK STORE Logo">
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

        <a href="favorites.php"><i class="far fa-heart icon-btn"></i></a>
        <a href="cart.php"><i class="fas fa-shopping-bag icon-btn"></i></a>
    </div>
</header>

<!-- DELIVERY BAR -->
<div class="delivery-bar-wrapper">
    <div class="delivery-bar">
        Free Standard Delivery & 30-Day Free Returns | 
        <a href="#">Join Now</a> | 
        <a href="#">View Details</a>
    </div>
</div>

<!-- LOGIN FORM -->
<div class="container">
    <h2>SIGN IN</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="input-box">
            <input type="email" name="email" placeholder="Vui lòng nhập email" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Vui lòng nhập mật khẩu" required>
        </div>

        <button class="btn" type="submit">SIGN IN</button>

        <div class="text-row">
            <span>Chưa có tài khoản?</span>
            <a href="signup.php">Đăng ký ngay</a>
        </div>

        <div class="text-row">
            <span>Quên mật khẩu?</span>
            <a href="../admin/khoiphuc.php">Khôi phục</a>
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
