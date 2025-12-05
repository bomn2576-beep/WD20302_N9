<?php
include "db.php";

// Thêm
if (isset($_POST['them'])) {
    $ten = $_POST['ten'];
    $mota = $_POST['mota'];
    mysqli_query($conn, "INSERT INTO danhmuc VALUES (NULL,'$ten','$mota')");
}

// Xóa
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    mysqli_query($conn, "DELETE FROM danhmuc WHERE id=$id");
}

// Lấy dữ liệu
$ds = mysqli_query($conn, "SELECT * FROM danhmuc");
?>

<h2 style="color:red;text-align:center">Quản Lý Danh Mục</h2>

<form method="post" style="text-align:center">
    <input type="text" name="ten" placeholder="Tên danh mục">
    <input type="text" name="mota" placeholder="Mô tả">
    <button name="them">Thêm</button>
</form>

<table border="1" width="80%" align="center" cellspacing="0" cellpadding="10">
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
            <a href="?xoa=<?= $row['id'] ?>">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
