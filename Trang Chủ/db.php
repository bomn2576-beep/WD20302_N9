<?php
// --- THIẾT LẬP KẾT NỐI DATABASE ---
$servername = "localhost";
$username = "root"; // Tên đăng nhập mặc định của XAMPP
$password = "";     // Mật khẩu mặc định của XAMPP (thường là rỗng)
$dbname = "shop_giay"; // Tên Database của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ------------------------------------

// 1. TRUY VẤN DỮ LIỆU FEATURED
$featured = [];
$sql_featured = "SELECT * FROM featured_items ORDER BY order_index ASC";
$result_featured = $conn->query($sql_featured);

if ($result_featured->num_rows > 0) {
    while($row = $result_featured->fetch_assoc()) {
        $featured[] = $row;
    }
}

// 2. TRUY VẤN DỮ LIỆU SLIDER - COLOUR OF THE SEASON
$season_products = [];
$sql_season = "SELECT * FROM products WHERE section = 'season'";
$result_season = $conn->query($sql_season);

if ($result_season->num_rows > 0) {
    while($row = $result_season->fetch_assoc()) {
        $season_products[] = $row;
    }
}

// 3. TRUY VẤN DỮ LIỆU SLIDER - SHOP BY ICONS
$icon_products = [];
$sql_icons = "SELECT * FROM products WHERE section = 'icons'";
$result_icons = $conn->query($sql_icons);

if ($result_icons->num_rows > 0) {
    while($row = $result_icons->fetch_assoc()) {
        $icon_products[] = $row;
    }
}

// KHÔNG ĐÓNG KẾT NỐI NGAY, ĐỂ HTML SỬ DỤNG.
// $conn->close();

?>