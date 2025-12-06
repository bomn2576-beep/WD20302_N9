<?php
include "db.php";

// Thêm
if (isset($_POST['them'])) {
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $hinh = $_POST['hinh'];

    mysqli_query($conn, "INSERT INTO sanpham VALUES (NULL,'$ten','$gia','$hinh')");
}

// Xóa
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    mysqli_query($conn, "DELETE FROM sanpham WHERE id=$id");
}

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

        <form method="post" style="text-align:center">
            <input type="text" name="ten" placeholder="Tên sản phẩm">
            <input type="number" name="gia" placeholder="Giá">
            <input type="text" name="hinh" placeholder="Link hình">
            <button name="them">Thêm</button>
        </form>

        <br>

        <table border="1" width="100%" align="center" cellpadding="10" cellspacing="0">
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
                <a href="?xoa=<?= $row['id'] ?>">Xóa</a>
            </td>
        </tr>
        <?php } ?>
        </table>

    </div>
</div>

</body>
</html>
