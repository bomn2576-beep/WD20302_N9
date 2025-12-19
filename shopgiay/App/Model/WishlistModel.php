<?php
class WishlistModel {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Lấy danh sách yêu thích của một người dùng cụ thể
    public function getWishlistByUser($userId) {
        $sql = "SELECT sp.id, sp.ten_san_pham, sp.gia_ban, sp.anh_dai_dien, sp.ma_sku 
                FROM danh_sach_yeu_thich yt
                JOIN san_pham sp ON yt.id_san_pham = sp.id
                WHERE yt.id_nguoi_dung = :userId
                ORDER BY yt.ngay_tao DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function remove($wishlistId) {
        $sql = "DELETE FROM danh_sach_yeu_thich WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $wishlistId);
        return $stmt->execute();
    }
}