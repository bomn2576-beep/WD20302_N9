<?php
// SỬ DỤNG require_once TỐT HƠN VÀ KIỂM TRA ĐỐI TƯỢNG KẾT NỐI
require_once "../config.php"; 

if (!isset($conn) || !$conn instanceof mysqli) {
    die("Lỗi: Không thể kết nối cơ sở dữ liệu. Vui lòng kiểm tra file db.php.");
}

// Hàm thực thi Prepared Statement an toàn
function execute_stmt($conn, $sql, $types, ...$params) {
    if ($stmt = $conn->prepare($sql)) {
        if (!empty($types)) {
            $stmt->bind_param($types, ...$params);
        }
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Lỗi thực thi SQL: " . $stmt->error);
            return false;
        }
    } else {
        error_log("Lỗi chuẩn bị SQL: " . $conn->error);
        return false;
    }
}

// ================= THÊM DANH MỤC (SỬ DỤNG PREPARED STATEMENT) =================
if (isset($_POST['them'])) {
    $ten = $_POST['ten'];
    $mota = $_POST['mota'];
    
    $sql = "INSERT INTO danhmuc (ten, mota) VALUES (?, ?)";
    execute_stmt($conn, $sql, "ss", $ten, $mota);

    header("Location: danhmuc.php");
    exit;
}

// ================= LẤY DANH MỤC ĐỂ SỬA (SỬ DỤNG PREPARED STATEMENT) =================
$dm_sua = null;
if (isset($_GET['sua'])) {
    $id = (int)$_GET['sua']; // Ép kiểu thành số nguyên để an toàn hơn
    
    $sql = "SELECT * FROM danhmuc WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dm_sua = $result->fetch_assoc();
        $stmt->close();
    }
}

// ================= CẬP NHẬT DANH MỤC (SỬ DỤNG PREPARED STATEMENT) =================
if (isset($_POST['capnhat'])) {
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $mota = $_POST['mota'];
    
    $sql = "UPDATE danhmuc SET ten = ?, mota = ? WHERE id = ?";
    execute_stmt($conn, $sql, "ssi", $ten, $mota, $id);

    header("Location: danhmuc.php");
    exit;
}

// ================= XÓA DANH MỤC (SỬ DỤNG PREPARED STATEMENT) =================
if (isset($_GET['xoa'])) {
    $id = (int)$_GET['xoa']; // Ép kiểu thành số nguyên
    
    $sql = "DELETE FROM danhmuc WHERE id = ?";
    execute_stmt($conn, $sql, "i", $id);

    header("Location: danhmuc.php");
    exit;
}

// ================= LẤY DANH SÁCH (THÊM XỬ LÝ LỖI) =================
$ds_result = mysqli_query($conn, "SELECT * FROM danhmuc");
if ($ds_result === false) {
    error_log("Lỗi truy vấn danh sách: " . mysqli_error($conn));
    $ds_result = []; // Gán mảng rỗng để vòng lặp không bị lỗi
}
?>
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

        <form method="post" style="text-align:center;margin-bottom:20px;">
            <input type="text" name="ten" placeholder="Tên danh mục" required>
            <input type="text" name="mota" placeholder="Mô tả" required>
            <button name="them">Thêm</button>
        </form>

        <?php if ($dm_sua): ?>
            <form method="post" style="text-align:center;margin-bottom:20px;">
                <h3 style="color:blue">Sửa danh mục ID: <?= htmlspecialchars($dm_sua['id']) ?></h3>
                <input type="hidden" name="id" value="<?= htmlspecialchars($dm_sua['id']) ?>">
                <input type="text" name="ten" value="<?= htmlspecialchars($dm_sua['ten']) ?>" placeholder="Tên danh mục">
                <input type="text" name="mota" value="<?= htmlspecialchars($dm_sua['mota']) ?>" placeholder="Mô tả">
                <button name="capnhat">Cập nhật</button>
                <a href="danhmuc.php" style="margin-left:20px">Hủy</a>
            </form>
        <?php endif; ?>

        <table border="1" width="100%" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>

            <?php while (is_object($ds_result) && $row = mysqli_fetch_assoc($ds_result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['ten']) ?></td>
                <td><?= htmlspecialchars($row['mota']) ?></td>
                <td>
                    <a href="?sua=<?= htmlspecialchars($row['id']) ?>">Sửa</a> |
                    <a href="?xoa=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>