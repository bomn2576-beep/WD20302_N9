<style>
        :root { --sidebar-width: 260px; --nike-black: #111; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* Sidebar (Giữ nguyên từ trang Dashboard) */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: var(--nike-black); color: white; padding-top: 20px; }
        .sidebar .nav-link { color: #adb5bd; padding: 12px 25px; display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,0.1); }

        /* Content */
        .main-content { margin-left: var(--sidebar-width); padding: 30px; }
        
        /* Product Table Custom */
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; background: #f5f5f5; }
        .table-container { background: white; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
        .search-box { max-width: 300px; border-radius: 20px; padding-left: 40px; }
        .search-wrapper { position: relative; }
        .search-wrapper i { position: absolute; left: 15px; top: 10px; color: #6c757d; }
        
        /* Buttons */
        .btn-add { background: var(--nike-black); color: white; border-radius: 25px; padding: 8px 20px; font-weight: 600; }
        .btn-add:hover { background: #333; color: white; }
        .action-btn { width: 35px; height: 35px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; transition: 0.3s; }
    </style>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Danh sách sản phẩm</h2>
    <a href="admin.php?page=add_product" class="btn btn-dark rounded-pill px-4">
        <i class="bi bi-plus-lg me-2"></i> Thêm sản phẩm
    </a>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $p): ?>
                <tr>
                    <td class="ps-4">
                        <img src="<?= $p['anh_dai_dien'] ?>" class="product-img" onerror="this.src='https://placehold.co/60px'">
                    </td>
                    <td>
                        <div class="fw-bold"><?= htmlspecialchars($p['ten_san_pham']) ?></div>
                        <small class="text-secondary">ID: #<?= $p['id'] ?></small>
                    </td>
                    <td class="fw-bold"><?= number_format($p['gia_ban'], 0, ',', '.') ?>₫</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center py-4">Chưa có sản phẩm nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>