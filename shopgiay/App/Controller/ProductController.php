<?php
class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function category() {
        $gender = $_GET['gender'] ?? null;
        
        if ($gender) {
            $products = $this->productModel->getProductsByGender($gender);
            $title = ucfirst($gender) . "'s Shoes";
        } else {
            $products = $this->productModel->getAllProducts();
            $title = "New & Featured";
        }

        $data = [
            'title' => $title . " | Nike Store",
            'products' => $products,
            // THÊM DÒNG NÀY ĐỂ TRUYỀN ĐƯỜNG DẪN ẢNH SANG VIEW
            'base_url_path' => $GLOBALS['base_url_path'], 
            'content_view' => ROOT_PATH . 'App/View/shop/category.php'
        ];

        extract($data);
        include ROOT_PATH . 'App/View/shop/main.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            header("Location: index.php");
            exit;
        }

        $data = [
            'title' => $product['ten_san_pham'] . " | Nike Store",
            'product' => $product,
            // THÊM DÒNG NÀY Ở ĐÂY NỮA
            'base_url_path' => $GLOBALS['base_url_path'],
            'content_view' => ROOT_PATH . 'App/View/shop/detail.php'
        ];

        extract($data);
        include ROOT_PATH . 'App/View/shop/main.php'; // Đảm bảo đúng đường dẫn main.php
    }
}
