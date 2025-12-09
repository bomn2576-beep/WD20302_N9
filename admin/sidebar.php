<style>
/* RESET CƠ BẢN */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    background: #111827;
    padding: 20px;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto; /* tránh bị tràn khi nhiều mục */
}

.sidebar-title {
    color: #38bdf8;
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;
}

/* MENU */
.menu {
    list-style: none;
}

.menu li {
    margin: 10px 0;
}

.menu a {
    display: block;
    padding: 12px;
    background: none;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.25s;
    font-size: 15px;
}

/* HOVER */
.menu a:hover {
    background: #1e293b;
    color: #fff;
}

/* ACTIVE */
.menu a.active {
    background: #1e293b;
    color: white !important;
    font-weight: bold;
}
</style>

<div class="sidebar">
    <div class="sidebar-title">ADMIN</div>

    <ul class="menu">
        <li><a href="dashboard.php"
            class="<?= basename($_SERVER['PHP_SELF'])=='dashboard.php' ? 'active' : '' ?>">
            Dashboard</a></li>

        <li><a href="danhmuc.php"
            class="<?= basename($_SERVER['PHP_SELF'])=='danhmuc.php' ? 'active' : '' ?>">
            Quản Lý Danh Mục</a></li>

        <li><a href="sanpham.php"
            class="<?= basename($_SERVER['PHP_SELF'])=='sanpham.php' ? 'active' : '' ?>">
            Quản Lý Sản Phẩm</a></li>

        <li><a href="donhang.php"
            class="<?= basename($_SERVER['PHP_SELF'])=='donhang.php' ? 'active' : '' ?>">
            Quản Lý Đơn Hàng</a></li>

        <li><a href="khachhang.php"
            class="<?= basename($_SERVER['PHP_SELF'])=='khachhang.php' ? 'active' : '' ?>">
            Quản Lý Khách Hàng</a></li>

        <li><a href="../Trang Chủ/index.php">Về trang web chính</a></li>
    </ul>
</div>
