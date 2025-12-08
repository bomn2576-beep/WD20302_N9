<?php
// heder.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>

    <!-- Load Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }

        /* Top banner */
        .top-banner{
            width:100%;
            background:#f0f0f0;
            padding:5px 40px;
            display:flex;
            justify-content:flex-end;
            font-size:13px;
            border-bottom:1px solid #ddd;
        }
        .top-banner a, .top-banner span{
            text-decoration:none;
            color:black;
            padding:0 10px;
            border-left:1px solid #ccc;
        }
        .top-banner a:first-child{border-left:none;}
        .top-banner span{font-weight:bold;}

        /* Header main */
        header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:15px 40px;
        }
        .logo img{width:50px;}

        nav{
            display:flex;
            gap:30px;
            padding-left:200px;   /* ⭐ DỊCH MENU SANG PHẢI  */
            
        }

        nav a{
            text-decoration:none;
            color:black;
            font-size:15px;
            font-weight:500;
            padding:5px 0;
            font-weight: 700;
        }
        nav a:hover{
            border-bottom:2px solid black;
        }

        .action-icons{
            display:flex;
            align-items:center;
            gap:15px;
        }
        .action-icons a{
            text-decoration:none;
            color:black;
        }
        .action-icons .icon-btn{
            font-size:20px;
            cursor:pointer;
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
            width:150px;
        }

        /* Delivery bar */
        .delivery-bar-wrapper{
            width:100%;
            background:#f0f0f0;
            padding:10px 40px;
            display:flex;
            justify-content:center;
        }
        .delivery-bar{
            font-size:14px;
        }
        .delivery-bar a{
            text-decoration:none;
            color:black;
            font-weight:bold;
            margin:0 5px;
        }
    </style>
</head>

<body>

<!-- TOP BANNER -->
<div class="top-banner">
    <a href="#">Find a Store</a>
<a href="#">Help</a>

    <?php if (isset($_SESSION['user_name'])): ?>
        <span>Hi, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
    <?php else: ?>
        <a href="../admin/signup.php">Join Us</a>
        <a href="../admin/login.php">Sign In</a>
    <?php endif; ?>
</div>

<!-- HEADER -->
<header>
    <div class="logo">
        <a href="../index.php">
            <img src="../img/z7221534069197_6c25de71b950f9ae79bfa8dceb795d4d.jpg" alt="PDK STORE Logo">
        </a>
    </div>

    <nav>
        <a href="#">New & Featured</a>
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

</body>
</html>