<?php
session_start();
include "../config.php"; // file kết nối DB

// XÓA ĐƠN HÀNG
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM donhang WHERE id = $id");
    header("Location: donhang.php");
    exit;
}

// CẬP NHẬT TRẠNG THÁI
if (isset($_POST['update_status'])) {
    $id = $_POST['order_id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE donhang SET trangthai = '$status' WHERE id = $id");
    header("Location: donhang.php");
    exit;
}

// LẤY DANH SÁCH ĐƠN HÀNG
$orders = mysqli_query($conn, "
    SELECT donhang.*, khachhang.ten, khachhang.email 
    FROM donhang 
    JOIN khachhang ON donhang.khachhang_id = khachhang.id
    ORDER BY donhang.id DESC
");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="style.css"> <!-- nếu có -->
    <style>
        .main {
            margin-left: 260px;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background: #111827;
            color: white;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background: #38bdf8;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .status-select {
            padding: 6px;
        }
    </style>
</head>

<body>

<?php include "sidebar.php"; ?>  <!-- nếu bạn dùng sidebar -->

<div class="main">
    <h2>Quản Lý Đơn Hàng</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Email</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['ten'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= number_format($row['tongtien'], 0, ',', '.') ?>₫</td>
            <td><?= $row['ngaydat'] ?></td>

            <td>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                    <select name="status" class="status-select">
                        <option value="Chờ xử lý" <?= $row['trangthai']=="Chờ xử lý"?"selected":"" ?>>Chờ xử lý</option>
                        <option value="Đang giao" <?= $row['trangthai']=="Đang giao"?"selected":"" ?>>Đang giao</option>
                        <option value="Hoàn tất" <?= $row['trangthai']=="Hoàn tất"?"selected":"" ?>>Hoàn tất</option>
                    </select>
                    <button type="submit" name="update_status" class="btn btn-edit">Lưu</button>
                </form>
            </td>

            <td>
                <a class="btn btn-delete" 
                   href="donhang.php?delete=<?= $row['id'] ?>"
                   onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này?')">
                   Xóa
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
