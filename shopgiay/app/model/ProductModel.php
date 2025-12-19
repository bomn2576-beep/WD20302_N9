<?php
class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Lấy tất cả sản phẩm
    public function getAllProducts() {
        $sql = "SELECT p.*, d.ten_danh_muc FROM san_pham p 
                LEFT JOIN danh_muc d ON p.id_danh_muc = d.id 
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 sản phẩm theo ID để sửa
    public function getProductById($id) {
        $sql = "SELECT * FROM san_pham WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // THÊM HÀM XÓA
    public function deleteProduct($id) {
        $sql = "DELETE FROM san_pham WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // THÊM HÀM CẬP NHẬT (SỬA)
    public function updateProduct($id, $data) {
        $sql = "UPDATE san_pham SET 
                id_danh_muc = :id_dm, 
                ten_san_pham = :ten, 
                gia_ban = :gia, 
                anh_dai_dien = :anh, 
                mo_ta = :mota 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_dm' => $data['id_danh_muc'],
            ':ten'   => $data['ten_san_pham'],
            ':gia'   => $data['gia_ban'],
            ':anh'   => $data['anh_dai_dien'],
            ':mota'  => $data['mo_ta'],
            ':id'    => $id
        ]);
    }

    public function insertProduct($data) {
        $sql = "INSERT INTO san_pham (id_danh_muc, ten_san_pham, gia_ban, anh_dai_dien, mo_ta) 
                VALUES (:id_dm, :ten, :gia, :anh, :mota)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_dm' => $data['id_danh_muc'],
            ':ten'   => $data['ten_san_pham'],
            ':gia'   => $data['gia_ban'],
            ':anh'   => $data['anh_dai_dien'],
            ':mota'  => $data['mo_ta']
        ]);
    }
}