<?php
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Hàm kiểm tra email đã tồn tại hay chưa
    public function checkEmailExists($email) {
        $sql = "SELECT id FROM nguoi_dung WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function insertUser($ho_ten, $email, $mat_khau, $ngay_sinh, $gioi_tinh) {
        $sql = "INSERT INTO nguoi_dung (ho_ten, email, mat_khau, ngay_sinh, gioi_tinh, id_vai_tro) 
                VALUES (:ho_ten, :email, :mat_khau, :ngay_sinh, :gioi_tinh, 2)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':ho_ten'    => $ho_ten,
            ':email'     => $email,
            ':mat_khau'  => $mat_khau,
            ':ngay_sinh' => $ngay_sinh,
            ':gioi_tinh' => $gioi_tinh
        ]);
    }

    public function getUserByEmail($email) {
    // Dùng SELECT * để lấy hết tất cả các cột bao gồm ho_ten
    $sql = "SELECT * FROM nguoi_dung WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}