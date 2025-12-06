<?php
include "db.php";

// Đếm số sản phẩm
$sp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS tong FROM sanpham"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dash-box{
            width: 250px;
            padding: 20px;
            border-radius: 10px;
            background: #f5f5f5;
            box-shadow: 0 0 5px #ccc;
            text-align:center;
            display:inline-block;
            margin:15px;
        }
        .dash-box h3{
            margin:0;
            color:#444;
        }
        .dash-box p{
            font-size:30px;
            font-weight:bold;
            margin-top:10px;
            color:blue;
        }
    </style>
</head>
<body>

<div class="admin-container">

    <?php include "sidebar.php"; ?>

    <div class="content">

        <h2 style="text-align:center;color:#008cff">Dashboard</h2>

        <div style="text-align:center">

            <div class="dash-box">
                <h3>Tổng sản phẩm</h3>
                <p><?= $sp['tong'] ?></p>
            </div>

            <div class="dash-box">
                <h3>Doanh thu (demo)</h3>
                <p>0 đ</p>
            </div>

            <div class="dash-box">
                <h3>Người dùng (demo)</h3>
                <p>0</p>
            </div>

        </div>

    </div>
</div>

</body>
</html>
