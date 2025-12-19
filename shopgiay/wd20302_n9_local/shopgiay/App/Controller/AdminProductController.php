<?php
class AdminProductController {
    public function list() {
        $model = new ProductModel();
        return $model->getAllProducts();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý upload ảnh
            $image = "";
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
                $target = "public/uploads/" . basename($_FILES['product_image']['name']);
                move_uploaded_file($_FILES['product_image']['tmp_name'], $target);
                $image = $_FILES['product_image']['name'];
            }
            
            // Gọi Model để insert (Bạn cần viết hàm này trong ProductModel)
            // $check = $model->insertProduct($_POST['name'], $_POST['price'], $image, ...);
            header("Location: admin.php?page=products&msg=added");
        }
    }

    public function delete($id) {
        // Gọi Model xóa sản phẩm theo ID
        header("Location: admin.php?page=products&msg=deleted");
    }
}