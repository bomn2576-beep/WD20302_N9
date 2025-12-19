<style>
        :root { --sidebar-width: 260px; --nike-black: #111; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* Sidebar */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: var(--nike-black); color: white; padding-top: 20px; z-index: 1000; }
        .sidebar .nav-link { color: #adb5bd; padding: 12px 25px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: 0.3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
        .sidebar .nav-link.active { border-left: 4px solid #fff; }

        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 40px; }
        
        /* Status Badges */
        .status-badge { padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background: #fff3cd; color: #856404; } /* Chờ xử lý */
        .status-shipping { background: #cce5ff; color: #004085; } /* Đang giao */
        .status-completed { background: #d1e7dd; color: #0f5132; } /* Hoàn thành */
        .status-cancelled { background: #f8d7da; color: #842029; } /* Đã hủy */

        /* Order Table */
        .order-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: none; }
        .nike-table thead th { background: #fafafa; border-bottom: 1px solid #eee; color: #888; font-size: 12px; font-weight: 700; text-transform: uppercase; padding: 15px 20px; }
        .nike-table tbody td { padding: 18px 20px; border-bottom: 1px solid #f8f9fa; font-size: 14px; }
        .order-row:hover { background-color: #fafafa; transition: 0.2s; }

        /* Action Buttons */
        .btn-action { width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s; background: #f8f9fa; color: #666; border: 1px solid #eee; }
        .btn-view:hover { background: #e8f0fe; color: #1a73e8; border-color: #1a73e8; }
        .btn-process:hover { background: #111; color: #fff; border-color: #111; }
    </style>
<div class="sidebar">
        <div class="px-4 mb-4"><h4 class="fw-bold">NIKE ADMIN</h4></div>
        <nav class="nav flex-column">
            <a href="admin.html" class="nav-link"><i class="bi bi-speedometer2"></i> Tổng quan</a>
            <a href="admin_products.html" class="nav-link"><i class="bi bi-box-seam"></i> Quản lý sản phẩm</a>
            <a href="admin_categories.html" class="nav-link"><i class="bi bi-list-ul"></i> Danh mục</a>
            <a href="admin_orders.html" class="nav-link active"><i class="bi bi-cart-check"></i> Đơn hàng</a>
            <a href="admin_list.html" class="nav-link"><i class="bi bi-person-badge"></i> Đội ngũ Admin</a>
            <hr class="mx-3 opacity-25">
            <a href="../index.html" class="nav-link text-info"><i class="bi bi-house"></i> Xem Website</a>
            <a href="#" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Quản lý đơn hàng</h2>
            <div class="d-flex gap-2">
                <button class="btn btn-white border rounded-pill px-3 fw-bold small shadow-sm">Xuất Excel</button>
            </div>
        </div>

        <div class="card order-card mb-4 p-3">
            <div class="d-flex gap-3 overflow-auto">
                <button class="btn btn-dark rounded-pill px-4 btn-sm fw-bold">Tất cả</button>
                <button class="btn btn-outline-secondary rounded-pill px-4 btn-sm fw-bold">Chờ xử lý (12)</button>
                <button class="btn btn-outline-secondary rounded-pill px-4 btn-sm fw-bold">Đang giao</button>
                <button class="btn btn-outline-secondary rounded-pill px-4 btn-sm fw-bold">Hoàn thành</button>
            </div>
        </div>

        <div class="card order-card overflow-hidden">
            <div class="table-responsive">
                <table class="table nike-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Khách hàng</th>
                            <th>Thanh toán</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th class="text-center pe-4">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="order-row">
                            <td class="ps-4 fw-bold">#NK-2025001</td>
                            <td>17/12/2025</td>
                            <td>
                                <div class="fw-bold">Lê Văn Cường</div>
                                <small class="text-secondary">0987-xxx-xxx</small>
                            </td>
                            <td><small class="fw-bold text-uppercase">COD</small></td>
                            <td class="fw-bold">5,400,000₫</td>
                            <td><span class="status-badge status-pending">Chờ xử lý</span></td>
                            <td class="text-center pe-4">
                                <a href="order_detail.html" class="btn-action btn-view me-1" title="Xem chi tiết"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn-action btn-process" title="Cập nhật trạng thái"><i class="bi bi-gear"></i></a>
                            </td>
                        </tr>
                        <tr class="order-row">
                            <td class="ps-4 fw-bold">#NK-2025002</td>
                            <td>16/12/2025</td>
                            <td>
                                <div class="fw-bold">Nguyễn Thị Hoa</div>
                                <small class="text-secondary">0912-xxx-xxx</small>
                            </td>
                            <td><small class="fw-bold text-uppercase text-primary">Chuyển khoản</small></td>
                            <td class="fw-bold">2,150,000₫</td>
                            <td><span class="status-badge status-shipping">Đang giao</span></td>
                            <td class="text-center pe-4">
                                <a href="order_detail.html" class="btn-action btn-view me-1"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn-action btn-process"><i class="bi bi-gear"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>