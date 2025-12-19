<style>
        :root { 
            --sidebar-width: 260px; 
            --nike-black: #111; 
            --bg-gray: #f8f9fa;
            --border-color: #e5e5e5;
        }

        body { 
            font-family: 'Inter', -apple-system, sans-serif; 
            background-color: var(--bg-gray); 
            color: var(--nike-black);
            margin: 0;
        }

        /* --- Sidebar --- */
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            background: var(--nike-black); 
            color: white; 
            padding-top: 24px;
            z-index: 1000;
        }
        
        .sidebar .brand { padding: 0 25px 30px; border-bottom: 1px solid #333; margin-bottom: 20px; }
        
        .sidebar .nav-link { 
            color: #8d8d8d; 
            padding: 12px 25px; 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            text-decoration: none;
            transition: 0.3s;
            font-size: 15px;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            color: white; 
            background: rgba(255,255,255,0.1); 
        }
        
        .sidebar .nav-link.active { border-left: 4px solid white; }

        /* --- Main Content --- */
        .main-content { 
            margin-left: var(--sidebar-width); 
            padding: 40px; 
            transition: all 0.3s;
        }

        .page-header h2 {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* --- Custom Card --- */
        .custom-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 28px;
            height: 100%;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--nike-black);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* --- Form Elements --- */
        .form-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 10px;
        }

        .input-nike {
            background-color: #f5f5f5;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 14px 18px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .input-nike:focus {
            background-color: #fff;
            border-color: var(--nike-black);
            box-shadow: none;
        }

        .btn-nike-dark {
            background: var(--nike-black);
            color: #fff;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn-nike-dark:hover {
            background: #333;
            transform: translateY(-2px);
        }

        /* --- Luxury Table --- */
        .table-responsive {
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .nike-table { margin-bottom: 0; }

        .nike-table thead th {
            background-color: #fafafa;
            border-bottom: 1px solid var(--border-color);
            color: #888;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 18px 20px;
        }

        .nike-table tbody td {
            padding: 20px;
            border-bottom: 1px solid #f1f1f1;
            vertical-align: middle;
            font-size: 15px;
        }

        .nike-table tbody tr:last-child td { border-bottom: none; }

        /* --- Badge & Buttons --- */
        .count-badge {
            background: #f0f0f0;
            color: var(--nike-black);
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: 0.2s;
            background: #f8f9fa;
            color: #666;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .btn-edit:hover { background: #e8f0fe; color: #1a73e8; border-color: #d2e3fc; }
        .btn-delete:hover { background: #fee8e8; color: #d93025; border-color: #fad2d2; }
        
    </style>

<div class="page-header">
    <h2>Quản lý danh mục</h2>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert alert-success border-0 shadow-sm mb-4">Thêm danh mục mới thành công!</div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="custom-card">
            <div class="card-title">
                <i class="bi bi-plus-circle-fill"></i> Thêm danh mục mới
            </div>
            <form action="admin.php?page=add_category" method="POST">
                <div class="mb-4">
                    <label class="form-label">Tên danh mục</label>
                    <input type="text" name="ten_danh_muc" class="form-control input-nike" placeholder="VD: Lifestyle, Jordan..." required>
                </div>
                <button type="submit" class="btn-nike-dark">Xác nhận thêm</button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="custom-card">
            <div class="card-title">
                <i class="bi bi-stack"></i> Danh sách hiện có
            </div>
            <div class="table-responsive">
                <table class="table nike-table">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th>Tên danh mục</th>
                            <th class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($categories)): foreach($categories as $cat): ?>
                            <tr>
                                <td class="text-secondary fw-bold">#<?= $cat['id'] ?></td>
                                <td><span class="fw-bold"><?= htmlspecialchars($cat['ten_danh_muc']) ?></span></td>
                                <td class="text-end">
                                    <a href="#" class="action-btn btn-edit me-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="admin.php?page=delete_category&id=<?= $cat['id'] ?>" 
                                       class="action-btn btn-delete" 
                                       onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="3" class="text-center">Chưa có dữ liệu.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>