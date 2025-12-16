<?php
// File: app/view/dang-cho-xu-ly.php
// Trang hiển thị trạng thái đơn đặt bàn

require_once ROOT_PATH . 'app/model/BookingModel.php';
$bookingModel = new BookingModel();

$bookingInfo = false;
$statusDisplay = ['text' => 'Đang tải...', 'color' => '#888', 'icon' => 'hourglass_empty'];
$errorMsg = null;

$bookingId = null;

// =======================================================
// >>> LOGIC CẦN THIẾT ĐỂ ƯU TIÊN ID TỪ TRA CỨU <<<
// 1. Nếu có ID trong URL, hãy sử dụng nó và BỎ QUA SESSION.
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookingId = (int)$_GET['id'];
    
    // RẤT QUAN TRỌNG: Xóa ID cũ trong session để nó không bị load lại
    // trong trường hợp người dùng tra cứu ID khác
    if (isset($_SESSION['checking_booking_id'])) {
        unset($_SESSION['checking_booking_id']);
    }

// 2. Nếu không có ID trong URL, hãy kiểm tra Session (Trường hợp ngay sau khi đặt hàng)
} elseif (isset($_SESSION['checking_booking_id'])) {
    $bookingId = (int)$_SESSION['checking_booking_id'];
}
// =======================================================


// Xử lý KIỂM TRA
if (!$bookingId) { 
    $errorMsg = "Không tìm thấy thông tin đơn hàng. Vui lòng cung cấp Mã đơn hàng.";
} else {
    // Dùng $bookingId đã lấy được
    $bookingInfo = $bookingModel->getFullBookingInfo($bookingId);
    
    if (!$bookingInfo) {
        $errorMsg = "Không tìm thấy đơn đặt bàn #$bookingId trong hệ thống.";
    }
}

// XỬ LÝ TRẠNG THÁI
if ($bookingInfo) {
    $statusId = (int)$bookingInfo['status'];
    switch ($statusId) {
        case 0:
            $statusDisplay = [
                'text' => 'ĐANG CHỜ ADMIN XỬ LÝ',
                'color' => '#ffc107',
                'icon' => 'hourglass_empty',
                'message' => 'Đơn hàng của bạn đang được nhân viên kiểm tra thanh toán và xác nhận.'
            ];
            break;
        case 1:
            $statusDisplay = [
                'text' => 'ĐẶT BÀN THÀNH CÔNG!',
                'color' => '#28a745',
                'icon' => 'check_circle',
                'message' => 'Đơn hàng của bạn đã được xác nhận. Hẹn gặp bạn tại nhà hàng!'
            ];
            break;
        case 2:
            $statusDisplay = [
                'text' => 'ĐẶT BÀN THẤT BẠI/ĐÃ HỦY',
                'color' => '#dc3545',
                'icon' => 'cancel',
                'message' => 'Đơn hàng của bạn đã bị hủy. Vui lòng liên hệ hotline để biết thêm chi tiết.'
            ];
            break;
        case 3:
            $statusDisplay = [
                'text' => 'ĐÃ HOÀN TẤT',
                'color' => '#007bff',
                'icon' => 'done_all',
                'message' => 'Cảm ơn bạn đã sử dụng dịch vụ!'
            ];
            break;
        default:
            $statusDisplay = [
                'text' => 'Không rõ trạng thái',
                'color' => '#888',
                'icon' => 'help',
                'message' => 'Vui lòng liên hệ nhà hàng để biết thêm chi tiết.'
            ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        .status-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .status-box h1 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
            color: <?= $statusDisplay['color'] ?>;
        }
        .status-icon {
            font-size: 72px;
            color: <?= $statusDisplay['color'] ?>;
            margin-bottom: 20px;
        }
        .error-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<section class="status-container">
    <div class="status-box">
        <?php if ($errorMsg): ?>
            <!-- HIỂN THỊ LỖI -->
            <span class="material-icons-outlined status-icon" style="color: #dc3545;">error</span>
            <h1 style="color: #dc3545;">Có lỗi xảy ra</h1>
            <div class="error-box">
                <p><?= htmlspecialchars($errorMsg) ?></p>
            </div>
            <a href="<?= $base_url_path ?>public/dat-ban" class="btn">Quay lại trang đặt bàn</a>
            
        <?php else: ?>
            <!-- HIỂN THỊ TRẠNG THÁI BÌNH THƯỜNG -->
            <span class="material-icons-outlined status-icon"><?= $statusDisplay['icon'] ?></span>
            <h1><?= $statusDisplay['text'] ?></h1>

            <p style="font-size: 18px; color: #555;">
                Mã đơn hàng: <strong>#<?= $bookingInfo['id'] ?></strong>
            </p>

            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 20px; text-align: left;">
                <p><strong>Khách hàng:</strong> <?= htmlspecialchars($bookingInfo['name']) ?></p>
                <p><strong>Chi nhánh:</strong> <?= htmlspecialchars($bookingInfo['branch']) ?></p>
                <p><strong>Tổng cọc:</strong> <?= number_format($bookingInfo['total'] ?? 0, 0, ',', '.') ?>đ</p>
                <p><strong>Còn lại:</strong> <?= number_format($bookingInfo['tien_thanh_toan_sau'] ?? 0, 0, ',', '.') ?>đ</p>
            </div>

            <!-- Chi tiết nếu thành công -->
            <?php if ((int)$bookingInfo['status'] === 1): ?>
                <div style="background: #d4edda; padding: 20px; border-radius: 10px; margin-top: 20px;">
                    <h3>Chi tiết đặt bàn:</h3>
                    <p><strong>Khách hàng:</strong> <?= htmlspecialchars($bookingInfo['name']) ?></p>
                    <p><strong>Chi nhánh:</strong> <?= htmlspecialchars($bookingInfo['branch']) ?></p>
                    <p><strong>Ngày/Giờ:</strong> <?= htmlspecialchars($bookingInfo['booking_date'] . ' ' . $bookingInfo['booking_time']) ?></p>
                    <p><strong>Số bàn:</strong> <?= htmlspecialchars($bookingInfo['soluongban']) ?></p>
                    <?php if (!empty($bookingInfo['cart'])): ?>
                        <h4>Món đã đặt:</h4>
                        <ul>
                            <?php foreach ($bookingInfo['cart'] as $item): ?>
                                <li><?= htmlspecialchars($item['ten_mon'] ?? 'Món ăn') ?> × <?= $item['so_luong'] ?> = <?= number_format($item['gia'] * $item['so_luong'], 0, ',', '.') ?>đ</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <p><strong>Tổng cọc:</strong> <?= number_format($bookingInfo['total'], 0, ',', '.') ?>đ</p>
                    <p><strong>Còn lại thanh toán tại chỗ:</strong> <?= number_format($bookingInfo['tien_thanh_toan_sau'], 0, ',', '.') ?>đ</p>
                </div>
            <?php elseif ((int)$bookingInfo['status'] === 2): ?>
                <div style="background: #f8d7da; padding: 20px; border-radius: 10px; margin-top: 20px;">
                    <p>Đặt bàn thất bại. Vui lòng liên hệ hotline để biết thêm chi tiết.</p>
                </div>
            <?php endif; ?>

            <!-- Nút và auto reload -->
            <?php if ((int)$bookingInfo['status'] === 0): ?>
                <button onclick="window.location.reload();" style="
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    margin-top: 20px;">
                    Kiểm tra lại trạng thái
                </button>
                
                
                <script>
                    setInterval(function() {
                        window.location.reload();
                    }, 15000); // 15 giây tự reload
                </script>
            <?php else: ?>
                <a href="<?= $base_url_path ?>public/index.php" class="btn">Về trang chủ</a>
            <?php endif; ?>

        <?php endif; // ← ĐÂY LÀ THẺ ĐÓNG QUAN TRỌNG BỊ THIẾU TRƯỚC ĐÓ ?>
    </div>
</section>

</body>
</html>