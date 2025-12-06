<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Danh Mục</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-container">

    <?php include "sidebar.php"; ?>

    <div class="content">

        <h2 style="color:red;text-align:center">Quản Lý Danh Mục</h2>

        <?php
        // ================= THÊM DANH MỤC =================
        if (isset($_POST['them'])) {
            $ten = $_POST['ten'];
            $mota = $_POST['mota'];
            mysqli_query($conn, "INSERT INTO danhmuc VALUES (NULL,'$ten','$mota')");
            header("Location: danhmuc.php");
            exit;
        }

        // ================= LẤY DANH MỤC ĐỂ SỬA =================
        $dm_sua = null;
        if (isset($_GET['sua'])) {
            $id = $_GET['sua'];
            $dm_sua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM danhmuc WHERE id=$id"));
        }

        // ================= CẬP NHẬT DANH MỤC =================
        if (isset($_POST['capnhat'])) {
            $id = $_POST['id'];
            $ten = $_POST['ten'];
            $mota = $_POST['mota'];
            mysqli_query($conn, "UPDATE danhmuc SET ten='$ten', mota='$mota' WHERE id=$id");
            header("Location: danhmuc.php");
            exit;
        }

        // ================= XÓA DANH MỤC =================
        if (isset($_GET['xoa'])) {
            $id = $_GET['xoa'];
            mysqli_query($conn, "DELETE FROM danhmuc WHERE id=$id");
            header("Location: danhmuc.php");
            exit;
        }

        // ================= LẤY DANH SÁCH =================
        $ds = mysqli_query($conn, "SELECT * FROM danhmuc");
        ?>

        <!-- FORM THÊM DANH MỤC -->
        <form method="post" style="text-align:center;margin-bottom:20px;">
            <input type="text" name="ten" placeholder="Tên danh mục" required>
            <input type="text" name="mota" placeholder="Mô tả" required>
            <button name="them">Thêm</button>
        </form>

        <!-- FORM SỬA DANH MỤC -->
        <?php if ($dm_sua): ?>
            <form method="post" style="text-align:center;margin-bottom:20px;">
                <h3 style="color:blue">Sửa danh mục ID: <?= $dm_sua['id'] ?></h3>
                <input type="hidden" name="id" value="<?= $dm_sua['id'] ?>">
                <input type="text" name="ten" value="<?= $dm_sua['ten'] ?>" placeholder="Tên danh mục">
                <input type="text" name="mota" value="<?= $dm_sua['mota'] ?>" placeholder="Mô tả">
                <button name="capnhat">Cập nhật</button>
                <a href="danhmuc.php" style="margin-left:20px">Hủy</a>
            </form>
        <?php endif; ?>

        <!-- BẢNG DANH SÁCH DANH MỤC -->
        <table border="1" width="100%" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($ds)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['ten'] ?></td>
                <td><?= $row['mota'] ?></td>
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
