<?php
session_start();

// Kiểm tra xem dữ liệu sản phẩm cần thiết có được truyền qua URL không
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['image']) && isset($_GET['category'])) {
    
    // Nhận dữ liệu từ URL
    $product_id = $_GET['id'];
    $name = urldecode($_GET['name']);
    $price = $_GET['price'];
    $image = urldecode($_GET['image']);
    $category = urldecode($_GET['category']);
    $size = "41"; // GIẢ ĐỊNH SIZE MẶC ĐỊNH
    $quantity = 1; // Mặc định mỗi lần click là thêm 1 sản phẩm
    
    // Khóa sản phẩm trong giỏ hàng (sử dụng ID)
    $unique_key = $product_id;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (array_key_exists($unique_key, $_SESSION['cart'])) {
        // Nếu sản phẩm đã có (cùng ID), tăng số lượng lên 1
        $_SESSION['cart'][$unique_key]['quantity'] += $quantity;
    } else {
        // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
        $_SESSION['cart'][$unique_key] = [
            'id' => $product_id,
            'name' => $name,
            'price' => (float)$price, // Đảm bảo giá là kiểu số
            'image' => $image,
            'category' => $category,
            'size' => $size,
            'quantity' => $quantity
        ];
    }
}

// Chuyển hướng người dùng về trang giỏ hàng (cart.php)
header('Location: cart.php');
exit;

?>