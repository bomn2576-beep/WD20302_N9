 <style>
        body {
            background: #111; /* Nền đen sang trọng */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .nike-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .form-control:focus {
            border-color: #000;
            box-shadow: none;
        }
        .btn-admin {
            background: #000;
            color: #fff;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-admin:hover {
            background: #333;
        }
        .admin-label {
            font-size: 12px;
            font-weight: 700;
            color: #777;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }

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
 <div class="sidebar">
        <div class="px-4 mb-4"><h4 class="fw-bold">NIKE ADMIN</h4></div>
        <nav class="nav flex-column">
            <a href="admin.html" class="nav-link active"><i class="bi bi-speedometer2"></i> Tổng quan</a>
            <a href="admin_products.html" class="nav-link"><i class="bi bi-box-seam"></i> Quản lý sản phẩm</a>
            <a href="admin_categories.html" class="nav-link"><i class="bi bi-list-ul"></i> Danh mục</a>
            <a href="admin_orders.html" class="nav-link"><i class="bi bi-cart-check"></i> Đơn hàng</a>
            <a href="admin_list.html" class="nav-link"><i class="bi bi-person-badge"></i> Đội ngũ Admin</a>
            <hr class="mx-3 opacity-25">
            <a href="../index.html" class="nav-link text-info"><i class="bi bi-house"></i> Xem Website</a>
            <a href="#" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
        </nav>
    </div>

    <div class="login-card">
        <div class="nike-logo">
            <svg width="60" height="60" viewBox="0 0 24 24"><path d="M21 8.719L7.836 14.303C6.74 14.768 5.818 15 5.075 15c-.836 0-1.445-.295-1.819-.884-.485-.76-.273-1.982.559-3.272.494-.754 1.122-1.446 1.734-2.108-.144.234-1.415 2.349-.025 3.345.275.2.666.298 1.147.298.386 0 .829-.063 1.316-.19L21 8.719z"></path></svg>
            <h4 class="fw-bold mt-3">ADMIN PORTAL</h4>
        </div>

        <form action="process_login.php" method="POST">
            <div class="mb-2">
                <span class="admin-label">Username / Email</span>
                <input type="text" name="username" class="form-control" placeholder="Nhập tên quản trị" required>
            </div>
            <div class="mb-2">
                <span class="admin-label">Password</span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Ghi nhớ</label>
                </div>
                <a href="#" class="small text-dark">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn btn-admin border-0">Đăng nhập hệ thống</button>
        </form>
    </div>
