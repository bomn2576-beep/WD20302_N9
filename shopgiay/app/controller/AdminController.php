<?php
class HomeController {
    private $conn;

    public function __construct() {
        // Khởi tạo kết nối database từ biến toàn cục hoặc gọi hàm kết nối
        $this->conn = getConnection(); 
    }

    public function index() {
        // 1. Lấy danh sách sản phẩm mới (is_new = 1)
        $sql_new = "SELECT * FROM products WHERE is_new = 1 ORDER BY created_at DESC LIMIT 8";
        $stmt_new = $this->conn->prepare($sql_new);
        $stmt_new->execute();
        $new_arrivals = $stmt_new->fetchAll(PDO::FETCH_ASSOC);

        // 2. Lấy sản phẩm phổ biến (Dựa trên lượt xem view_count)
        $sql_popular = "SELECT * FROM products ORDER BY view_count DESC LIMIT 4";
        $stmt_popular = $this->conn->prepare($sql_popular);
        $stmt_popular->execute();
        $popular_products = $stmt_popular->fetchAll(PDO::FETCH_ASSOC);

        // 3. Lấy danh mục cho phần "Shop by Sport"
        $sql_cats = "SELECT * FROM categories LIMIT 4";
        $stmt_cats = $this->conn->prepare($sql_cats);
        $stmt_cats->execute();
        $categories = $stmt_cats->fetchAll(PDO::FETCH_ASSOC);

        // 4. Truyền dữ liệu sang view
        // ROOT_PATH đã được định nghĩa ở index.php của bạn
        require_once ROOT_PATH . 'app/view/header.php';
        require_once ROOT_PATH . 'app/view/home.php';
        require_once ROOT_PATH . 'app/view/footer.php';
    }
}