<?php
include "db.php";

// ====================== THÊM KH ======================
if (isset($_POST['them'])) {
    $ten = $_POST['ten'];
    $email = $_POST['email'];

    mysqli_query($conn, "INSERT INTO khachhang VALUES (NULL,'$ten','$email')");
    header("Location: khachhang.php"); // tránh lỗi submit lại
    exit;
}

// ====================== LẤY KHÁCH HÀNG ĐỂ SỬA ======================
$kh_sua = null;
if (isset($_GET['sua'])) {
    $id = $_GET['sua'];
    $kh_sua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM khachhang WHERE id=$id"));
}

// ====================== CẬP NHẬT KH ======================
if (isset($_POST['capnhat'])) {
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE khachhang SET ten='$ten', email='$email' WHERE id=$id");
    header("Location: khachhang.php");
    exit;
}

// ====================== XÓA KH ======================
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    mysqli_query($conn, "DELETE FROM khachhang WHERE id=$id");
    header("Location: khachhang.php");
    exit;
}

// ====================== LẤY DANH SÁCH ======================
$ds = mysqli_query($conn, "SELECT * FROM khachhang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Khách Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-container">

    <?php include "sidebar.php"; ?>

    <div class="content">

        <h2 style="color:red;text-align:center">Quản Lý Khách Hàng</h2>

        <!-- FORM THÊM KHÁCH HÀNG -->
        <form method="post" style="text-align:center;margin-bottom:20px;">
            <input type="text" name="ten" placeholder="Họ tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <button name="them">Thêm</button>
        </form>

        <!-- FORM SỬA KHÁCH HÀNG -->
        <?php if ($kh_sua): ?>
            <form method="post" style="text-align:center;margin-bottom:20px;">
                <h3 style="color:blue">Sửa khách hàng ID: <?= $kh_sua['id'] ?></h3>
                <input type="hidden" name="id" value="<?= $kh_sua['id'] ?>">
                <input type="text" name="ten" value="<?= $kh_sua['ten'] ?>" placeholder="Họ tên">
                <input type="email" name="email" value="<?= $kh_sua['email'] ?>" placeholder="Email">
                <button name="capnhat">Cập nhật</button>
                <a href="khachhang.php" style="margin-left:20px">Hủy</a>
            </form>
        <?php endif; ?>

        <!-- BẢNG DANH SÁCH KHÁCH HÀNG -->
        <table border="1" width="100%" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($ds)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['ten'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="?sua=<?= $row['id'] ?>">Sửa</a> |
                    <a href="?xoa=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>
