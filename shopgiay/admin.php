<?php
ob_start();
session_start();

// 1. Sửa đường dẫn database cho đúng với cấu trúc folder của bạn
require_once 'App/config/database.php'; 
require_once 'App/Model/ProductModel.php';
require_once 'App/Model/CategoryModel.php'; // Cần để hiện danh mục trong form thêm

$productModel = new ProductModel();
$categoryModel = new CategoryModel();
$page = $_GET['page'] ?? 'dashboard';

// --- XỬ LÝ LOGIC ---

// 1. Xử lý Thêm sản phẩm
if ($page == 'insert_product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id_danh_muc'  => $_POST['id_danh_muc'],
        'ten_san_pham' => $_POST['ten_san_pham'],
        'gia_ban'      => $_POST['gia_ban'],
        'anh_dai_dien' => $_POST['anh_dai_dien'],
        'mo_ta'        => $_POST['mo_ta']
    ];
    if ($productModel->insertProduct($data)) {
        header("Location: admin.php?page=products&msg=success");
    } else {
        header("Location: admin.php?page=products&msg=error");
    }
    exit();
}

// 2. Xử lý Xóa sản phẩm
if ($page == 'delete_product') {
    $id = $_GET['id'] ?? null;
    if ($id && $productModel->deleteProduct($id)) {
        header("Location: admin.php?page=products&msg=deleted");
    } else {
        header("Location: admin.php?page=products&msg=del_error");
    }
    exit();
}

// 3. Xử lý Cập nhật sản phẩm (Sửa)
if ($page == 'update_product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $data = [
        'id_danh_muc'  => $_POST['id_danh_muc'],
        'ten_san_pham' => $_POST['ten_san_pham'],
        'gia_ban'      => $_POST['gia_ban'],
        'anh_dai_dien' => $_POST['anh_dai_dien'],
        'mo_ta'        => $_POST['mo_ta']
    ];
    if ($productModel->updateProduct($id, $data)) {
        header("Location: admin.php?page=products&msg=updated");
    } else {
        header("Location: admin.php?page=products&msg=upd_error");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PKD Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-width: 260px; --nike-black: #111; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; margin: 0; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: var(--nike-black); color: white; padding-top: 20px; z-index: 1000; }
        .sidebar .nav-link { color: #8d8d8d; padding: 12px 25px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: 0.3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
        .sidebar .nav-link.active { border-left: 4px solid #fff; }
        .main-content { margin-left: var(--sidebar-width); padding: 40px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="px-4 mb-4"><h4 class="fw-bold">PKD ADMIN</h4></div>
    <nav class="nav flex-column">
        <a href="admin.php?page=dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>"><i class="bi bi-speedometer2"></i> Tổng quan</a>
        <a href="admin.php?page=products" class="nav-link <?= ($page == 'products' || $page == 'add_product' || $page == 'edit_product') ? 'active' : '' ?>"><i class="bi bi-box-seam"></i> Quản lý sản phẩm</a>
        <a href="admin.php?page=categories" class="nav-link <?= $page == 'categories' ? 'active' : '' ?>"><i class="bi bi-list-ul"></i> Danh mục</a>
        <a href="admin.php?page=orders" class="nav-link <?= $page == 'orders' ? 'active' : '' ?>"><i class="bi bi-cart-check"></i> Đơn hàng</a>
        <hr class="mx-3 opacity-25">
        <a href="index.php" class="nav-link text-info"><i class="bi bi-house"></i> Xem Website</a>
    </nav>
</div>

<div class="main-content">
    <?php 
    switch ($page) {
        case 'products':
            $products = $productModel->getAllProducts();
            include 'App/View/admin/admin_products.php'; 
            break;
        case 'add_product':
            $categories = $categoryModel->getAll(); // Lấy để hiện trong select box
            include 'App/View/admin/admin_add_product.php'; 
            break;
        case 'edit_product':
            $id = $_GET['id'] ?? null;
            $product = $productModel->getProductById($id);
            $categories = $categoryModel->getAll();
            include 'App/View/admin/admin_edit_product.php'; 
            break;
        case 'categories':
            $categories = $categoryModel->getAll();
            include 'App/View/admin/admin_categories.php'; 
            break;
        case 'dashboard':
        default:
            // Sửa lại để include file dashboard thống kê, không include lại chính file admin.php
            include 'App/View/admin/admin.php'; 
            break;
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>