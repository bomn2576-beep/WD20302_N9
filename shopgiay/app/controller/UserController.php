<?php
require_once ROOT_PATH . 'App/Model/UserModel.php'; 

class UserController {
    // Xử lý Đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $userModel = new UserModel();

            // Kiểm tra trùng email trước khi tạo
            if ($userModel->getUserByEmail($email)) {
                header("Location: index.php?page=register&error=duplicate_email");
                exit;
            }

            $ho_ten = $_POST['first_name'] . ' ' . $_POST['last_name'];
            $mat_khau = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $ngay_sinh = $_POST['birthday'];
            $gioi_tinh = $_POST['gender'];

            $check = $userModel->insertUser($ho_ten, $email, $mat_khau, $ngay_sinh, $gioi_tinh);
            
            if ($check) {
                header("Location: index.php?page=login&msg=success");
            } else {
                header("Location: index.php?page=register&msg=error");
            }
            exit;
        }
    }

    // Xử lý Đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            // Kiểm tra email tồn tại
            if (!$user) {
                header("Location: index.php?page=login&error=notfound");
                exit;
            }

            // Kiểm tra mật khẩu (hỗ trợ cả tài khoản cũ trong SQL của bạn và tài khoản mới đăng ký)
            if ($password === $user['mat_khau'] || password_verify($password, $user['mat_khau'])) { 
                // LƯU TÊN VÀO SESSION ĐỂ HIỆN TRÊN HEADER
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['ho_ten']; 
                
                header("Location: index.php?page=home");
                exit();
            } else {
                header("Location: index.php?page=login&error=wrongpass");
                exit();
            }
        }
    }
}