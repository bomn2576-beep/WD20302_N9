<?php
class CartController {
    // Hiển thị giỏ hàng
    public function index() {
        $productModel = new ProductModel();
        $cartItems = [];
        $totalPrice = 0;

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $line_id => $item) {
                $product = $productModel->getProductById($item['id']);
                if ($product) {
                    $product['line_id'] = $line_id;
                    $product['selected_size'] = $item['size'];
                    $product['quantity'] = $item['qty']; 
                    $product['subtotal'] = $product['gia_ban'] * $item['qty'];
                    
                    $cartItems[] = $product;
                    $totalPrice += $product['subtotal'];
                }
            }
        }

        $data = [
            'title' => 'Bag | Nike',
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'base_url_path' => $GLOBALS['base_url_path'],
            'content_view' => ROOT_PATH . 'App/View/shop/cart.php'
        ];

        extract($data);
        include ROOT_PATH . 'App/View/shop/main.php';
    }

    // Thêm vào giỏ
    public function add() {
        $id = $_GET['id'] ?? null;
        $size = $_GET['size'] ?? 'N/A';
        if ($id) {
            if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
            // Tạo line_id độc nhất
            $line_id = $id . "_" . $size . "_" . uniqid();
            $_SESSION['cart'][$line_id] = ['id' => $id, 'size' => $size, 'qty' => 1];
        }
        header("Location: index.php?page=cart");
        exit();
    }

    // HÀM QUAN TRỌNG: Tăng giảm số lượng
    public function update() {
        $line_id = $_GET['id'] ?? null;
        $type = $_GET['type'] ?? ''; 

        if ($line_id && isset($_SESSION['cart'][$line_id])) {
            if ($type === 'plus') {
                $_SESSION['cart'][$line_id]['qty'] += 1;
            } elseif ($type === 'minus') {
                if ($_SESSION['cart'][$line_id]['qty'] > 1) {
                    $_SESSION['cart'][$line_id]['qty'] -= 1;
                } else {
                    unset($_SESSION['cart'][$line_id]); // Nếu trừ xuống 0 thì xóa luôn
                }
            }
        }
        header("Location: index.php?page=cart");
        exit();
    }

    public function remove() {
        $line_id = $_GET['id'] ?? null;
        if ($line_id && isset($_SESSION['cart'][$line_id])) {
            unset($_SESSION['cart'][$line_id]);
        }
        header("Location: index.php?page=cart");
        exit();
    }
}