<?php
// SỬA LỖI ĐƯỜNG DẪN: Sử dụng "../config.php" để đi ra thư mục cha
require_once "../config.php"; 

// 1. Khởi tạo giá trị mặc định để tránh lỗi 'Undefined Index'
$sp = ['tong' => 0]; 
$sql = "SELECT COUNT(*) AS tong FROM sanpham";

// 2. Sử dụng Prepared Statement (Hướng đối tượng) và Xử lý lỗi
if (isset($conn) && $conn instanceof mysqli) {
    if ($stmt = $conn->prepare($sql)) {
        
        // 3. Thực thi truy vấn
        if ($stmt->execute()) {
            
            // 4. Lấy kết quả
            $result = $stmt->get_result();
            
            // 5. Kiểm tra và lấy dữ liệu
            if ($result && $result->num_rows > 0) {
                $sp = $result->fetch_assoc();
            }
            
            $stmt->close(); // Đóng statement
        } else {
            // Ghi log lỗi thực thi
            error_log("Lỗi thực thi truy vấn: " . $stmt->error);
        }
    } else {
        // Ghi log lỗi chuẩn bị truy vấn (thường là lỗi cú pháp SQL)
        error_log("Lỗi chuẩn bị truy vấn: " . $conn->error);
    }
} else {
    // Xử lý khi biến $conn không tồn tại (lỗi trong config.php)
    error_log("Lỗi: Không tìm thấy đối tượng kết nối cơ sở dữ liệu \$conn.");
}

// KHÔNG CẦN THAY ĐỔI PHẦN HTML NỮA
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        /* CSS */
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
            <p><?= htmlspecialchars($sp['tong'] ?? 0) ?></p>
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