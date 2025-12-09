<?php
include "../config.php";

// ====================== THÊM ======================
if (isset($_POST['them'])) {
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $hinh = $_POST['hinh'];
    mysqli_query($conn, "INSERT INTO sanpham VALUES (NULL,'$ten','$gia','$hinh')");
}

// ====================== XÓA ======================
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    mysqli_query($conn, "DELETE FROM sanpham WHERE id=$id");
    header("Location: sanpham.php");
    exit();
}

// ====================== LẤY SẢN PHẨM ĐỂ SỬA ======================
$sp_sua = null;
if (isset($_GET['sua'])) {
    $id = $_GET['sua'];
    $sp_sua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sanpham WHERE id=$id"));
}

// ====================== CẬP NHẬT ======================
if (isset($_POST['capnhat'])) {
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $hinh = $_POST['hinh'];

    mysqli_query($conn, "UPDATE sanpham SET ten='$ten', gia='$gia', hinh='$hinh' WHERE id=$id");

    header("Location: sanpham.php");
    exit();
}

// Lấy danh sách sản phẩm
$ds = mysqli_query($conn, "SELECT * FROM sanpham");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-container">
    
    <?php include "sidebar.php"; ?>

    <div class="content">

        <h2 style="color:red;text-align:center">Quản Lý Sản Phẩm</h2>

        <!-- FORM THÊM HOẶC SỬA -->
        <form method="post" style="text-align:center">

            <?php if ($sp_sua) { ?>
                <h3 style="color:blue">Đang sửa sản phẩm ID: <?= $sp_sua['id'] ?></h3>
                <input type="hidden" name="id" value="<?= $sp_sua['id'] ?>">
            <?php } ?>

            <input type="text" name="ten" placeholder="Tên sản phẩm" 
                value="<?= $sp_sua ? $sp_sua['ten'] : '' ?>">

            <input type="number" name="gia" placeholder="Giá" 
                value="<?= $sp_sua ? $sp_sua['gia'] : '' ?>">

            <input type="text" name="hinh" placeholder="Link hình" 
                value="<?= $sp_sua ? $sp_sua['hinh'] : '' ?>">

            <button name="<?= $sp_sua ? 'capnhat' : 'them' ?>">
                <?= $sp_sua ? 'Cập nhật' : 'Thêm' ?>
            </button>

            <!-- Hiện nút Hủy khi đang sửa -->
            <?php if ($sp_sua) { ?>
                <a href="sanpham.php" style="margin-left:20px">Hủy</a>
            <?php } ?>

        </form>

        <br><br>

        <table border="1" width="100%" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($ds)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['ten'] ?></td>
                <td><?= number_format($row['gia']) ?>đ</td>
                <td><img src="<?= $row['hinh'] ?>" width="80"></td>
                <td>
                    <a href="?sua=<?= $row['id'] ?>">Sửa</a> | 
                    <a href="?xoa=<?= $row['id'] ?>" onclick="return confirm('Xóa sản phẩm?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
</div>

</body>
</html>
