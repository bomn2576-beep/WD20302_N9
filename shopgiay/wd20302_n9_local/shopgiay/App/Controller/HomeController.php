<?php
class HomeController {
    public function index() {
    $productModel = new ProductModel();
    
    // Lấy tất cả sản phẩm mới (giới hạn 4)
    $newProducts = $productModel->getAllProducts(); 
    
    // Lấy danh sách danh mục (Basketball, Tennis, Football...)
    // Bạn có thể viết thêm hàm getAllCategories() trong ProductModel
    $sql = "SELECT * FROM danh_muc LIMIT 4";
    $stmt = (getConnection())->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [
        'title' => 'Nike Home',
        'newProducts' => array_slice($newProducts, 0, 4),
        'categories' => $categories, // Biến này chứa Basketball, Tennis...
        'base_url_path' => $GLOBALS['base_url_path'],
        'content_view' => ROOT_PATH . 'App/View/shop/home.php'
    ];
    
    extract($data);
    include ROOT_PATH . 'App/View/shop/main.php';
}
}