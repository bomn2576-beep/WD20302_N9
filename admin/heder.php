<?php
// header.php
?>
<!-- Header + Top Banner + Delivery Bar -->
<style>
    *{margin:0;padding:0;box-sizing:border-box;font-family: Arial, sans-serif;}
    .top-banner{width:100%;background:#f0f0f0;padding:5px 40px;display:flex;justify-content:flex-end;font-size:13px;border-bottom:1px solid #ddd;}
    .top-banner a{text-decoration:none;color:black;padding:0 10px;border-left:1px solid #ccc;}
    .top-banner a:first-child{border-left:none;}

    header{display:grid;grid-template-columns:auto 1fr auto;align-items:center;padding:15px 40px;}
    .logo img{width:50px;}
    nav{display:flex;gap:25px;justify-content:center;}
    nav a{text-decoration:none;color:black;font-size:15px;font-weight:500;}
    nav a:hover{border-bottom:2px solid black;}
    .action-icons{display:flex;align-items:center;gap:15px;}
    .action-icons a{text-decoration:none;color:black;}
    .action-icons .search-box{display:flex;align-items:center;background:#f5f5f5;border-radius:20px;padding:5px 15px;}
    .search-box input{border:none;background:none;outline:none;padding:5px;font-size:14px;width:150px;}

    .delivery-bar-wrapper{width:100%;background:#f0f0f0;padding:10px 40px;}
    .delivery-bar{text-align:center;font-size:14px;}
</style>

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
