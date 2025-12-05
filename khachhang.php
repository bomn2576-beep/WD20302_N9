<?php
include "db.php";

// Thêm
if (isset($_POST['them'])) {
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    mysqli_query($conn, "INSERT INTO khachhang VALUES (NULL,'$ten','$email')");
}

// Xóa
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    mysqli_query($conn, "DELETE FROM khachhang WHERE id=$id");
}

$ds = mysqli_query($conn, "SELECT * FROM khachhang");
?>

<h2 style="color:red;text-align:center">Quản Lý Khách Hàng</h2>

<form method="post" style="text-align:center">
    <input type="text" name="ten" placeholder="Họ tên">
    <input type="email" name="email" placeholder="Email">
    <button name="them">Thêm</button>
</form>

<table border="1" width="80%" align="center" cellpadding="10">
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
        <a href="?xoa=<?= $row['id'] ?>">Xóa</a>
    </td>
</tr>
<?php } ?>
</table>
