<?php
session_start();

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

// Đường dẫn gốc dùng để nạp ảnh/css/js
$base_url_path = "/wd20302_n9_local/shopgiay/";
$GLOBALS['base_url_path'] = $base_url_path;

// Nạp cấu hình Database và các Model dùng chung
require_once ROOT_PATH . 'App/Config/database.php';
require_once ROOT_PATH . 'App/Model/ProductModel.php';
require_once ROOT_PATH . 'App/Model/CartModel.php';

$page = $_GET['page'] ?? 'home';

// Tạo mảng dữ liệu mặc định luôn chứa đường dẫn gốc
$defaultData = ['base_url_path' => $base_url_path];

switch ($page) {
    case 'home':
        require_once ROOT_PATH . 'App/Controller/HomeController.php';
        (new HomeController())->index();
        break;

    case 'category':
    case 'new_featured':
    case 'detail':
    case 'sale':
        require_once ROOT_PATH . 'App/Controller/ProductController.php';
        $productController = new ProductController();
        if ($page == 'detail') {
            $productController->detail();
        } else {
            $productController->category();
        }
        break;

    case 'wishlist':
        require_once ROOT_PATH . 'App/Controller/WishlistController.php';
        (new WishlistController())->index();
        break;

    case 'cart':
    case 'checkout':
        require_once ROOT_PATH . 'App/Controller/CartController.php';
        $cartController = new CartController();
        if ($page == 'checkout') {
            $cartController->checkout();
        } else {
            $action = $_GET['action'] ?? 'index';
            if ($action == 'add') { $cartController->add(); } 
            elseif ($action == 'remove') { $cartController->remove(); } 
            else { $cartController->index(); }
        }
        break;

    case 'login':
        $data = array_merge($defaultData, [
            'title' => 'Sign In', 
            'content_view' => ROOT_PATH . 'App/View/shop/login.php'
        ]);
        extract($data);
        include ROOT_PATH . 'App/View/shop/main.php';
        break;

    case 'register':
        $data = array_merge($defaultData, [
            'title' => 'Become a Member', 
            'content_view' => ROOT_PATH . 'App/View/shop/register.php'
        ]);
        extract($data);
        include ROOT_PATH . 'App/View/shop/main.php';
        break;

    case 'auth_register':
        require_once ROOT_PATH . 'App/Controller/UserController.php';
        (new UserController())->register();
        break;

    case 'auth_login':
        require_once ROOT_PATH . 'App/Controller/UserController.php';
        (new UserController())->login();
        break;

    case 'logout':
        session_destroy(); // Xóa toàn bộ phiên đăng nhập
        header("Location: index.php?page=home");
        exit();
        break;
    
    case 'cart':
    require_once ROOT_PATH . 'App/Controller/CartController.php';
    $cartController = new CartController();
    $action = $_GET['action'] ?? 'index';
    
    if ($action == 'add') {
        $cartController->add();
    } elseif ($action == 'update') {
        $cartController->update(); // Thêm dòng này để xử lý nút tăng giảm
    } elseif ($action == 'remove') {
        $cartController->remove();
    } else {
        $cartController->index();
    }
    break;

    default:
        echo "<h1>404 - Not Found</h1>";
        break;
}