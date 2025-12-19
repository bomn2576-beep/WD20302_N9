<?php
class WishlistController {
    public function index() {
        // Lấy danh sách ID sản phẩm từ Session Wishlist
        $wishlistItems = $_SESSION['wishlist'] ?? [];
        $displayProducts = [];

        if (!empty($wishlistItems)) {
            $productModel = new ProductModel();
            foreach ($wishlistItems as $productId) {
                $product = $productModel->getProductById($productId);
                if ($product) {
                    $displayProducts[] = $product;
                }
            }
        }

        $data = [
            'title' => 'My Wishlist | Nike',
            'products' => $displayProducts,
            'content_view' => ROOT_PATH . 'App/View/shop/wishlist.php'
        ];
        extract($data);
        include ROOT_PATH . 'App/View/shop/main.php';
    }
}