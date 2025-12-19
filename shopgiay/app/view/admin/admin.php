<?php
// Sử dụng hàm getConnection() từ database.php của bạn
$conn = getConnection();

// 1. Tổng doanh thu (Sửa tên cột theo file SQL của bạn)
try {
    // Trong file SQL của bạn, bảng là 'don_hang', cột là 'tong_tien'
    $totalRevenue = $conn->query("SELECT SUM(tong_tien) FROM don_hang WHERE trang_thai = 'delivered'")->fetchColumn() ?: 0;
} catch (Exception $e) { $totalRevenue = 0; }

// 2. Đơn hàng mới (Sửa trạng thái theo ENUM trong SQL: 'pending')
try {
    $newOrders = $conn->query("SELECT COUNT(*) FROM don_hang WHERE trang_thai = 'pending'")->fetchColumn() ?: 0;
} catch (Exception $e) { $newOrders = 0; }

// 3. Tổng sản phẩm (Bảng 'san_pham')
$totalProducts = $conn->query("SELECT COUNT(*) FROM san_pham")->fetchColumn();

// 4. Tổng người dùng (SỬA LỖI: Cột đúng là 'id_vai_tro', ID 2 là customer)
$totalUsers = $conn->query("SELECT COUNT(*) FROM nguoi_dung WHERE id_vai_tro = 2")->fetchColumn();
?>

<div class="main-content-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Bảng điều khiển</h2>
        <div class="text-secondary">Chào Admin, chúc một ngày tốt lành!</div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white text-dark shadow-sm border-0" style="border-radius: 16px;">
                <div class="text-secondary small fw-bold">TỔNG DOANH THU</div>
                <h3 class="fw-bold mt-2"><?= number_format($totalRevenue, 0, ',', '.') ?>₫</h3>
                <div class="text-success small">Đã hoàn thành</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white text-dark shadow-sm border-0" style="border-radius: 16px;">
                <div class="text-secondary small fw-bold">ĐƠN HÀNG MỚI</div>
                <h3 class="fw-bold mt-2"><?= $newOrders ?></h3>
                <div class="text-info small">Chờ xử lý</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white text-dark shadow-sm border-0" style="border-radius: 16px;">
                <div class="text-secondary small fw-bold">SẢN PHẨM</div>
                <h3 class="fw-bold mt-2"><?= $totalProducts ?></h3>
                <div class="text-secondary small">Trong kho</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-dark text-white shadow-sm border-0" style="border-radius: 16px;">
                <div class="text-white-50 small fw-bold">KHÁCH HÀNG</div>
                <h3 class="fw-bold mt-2 text-white"><?= $totalUsers ?></h3>
                <div class="text-white-50 small">Thành viên Nike</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-4 border-0 shadow-sm" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">Thống kê doanh thu</h5>
                <div style="height: 300px;"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 border-0 shadow-sm" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">Danh mục</h5>
                <div style="height: 300px;"><canvas id="categoryChart"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Script biểu đồ giữ nguyên
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
            datasets: [{ label: 'VNĐ', data: [12, 19, 15, 25, 22, 30, 28], borderColor: '#111', tension: 0.4 }]
        }
    });
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: ['Jordan', 'Running', 'Lifestyle'],
            datasets: [{ data: [40, 30, 30], backgroundColor: ['#111', '#555', '#999'] }]
        }
    });
</script>