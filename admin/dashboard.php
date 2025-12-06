<?php
include "db.php";

// Đếm số sản phẩm
$sp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS tong FROM sanpham"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f3f4f6;
        }

        /* Đẩy nội dung qua phải vì sidebar cố định */
        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .page-title {
            font-size: 28px;
            text-align: center;
            margin-bottom: 25px;
            color: #0ea5e9;
            font-weight: bold;
        }

        /* Các box */
        .dash-box {
            width: 250px;
            padding: 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            text-align: center;
            display: inline-block;
            margin: 15px;
        }

        .dash-box h3 {
            margin: 0;
            color: #334155;
            font-size: 18px;
        }

        .dash-box p {
            font-size: 32px;
            font-weight: bold;
            margin-top: 10px;
            color: #0284c7;
        }
    </style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">

    <div class="page-title">Dashboard</div>

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

</body>
</html>
