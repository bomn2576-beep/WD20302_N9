<?php
class CartModel {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    /**
     * Lấy thông tin chi tiết sản phẩm để hiển thị trong giỏ
     * Được dùng để lấy tên, ảnh, giá và SKU từ database
     */
   public function getProductDetails($id) {
    $sql = "SELECT id, ten_san_pham, gia_ban, gia_khuyen_mai, anh_dai_dien, ma_sku FROM san_pham WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    /**
     * (Bổ sung) Lấy danh sách sản phẩm gợi ý dựa trên danh mục của sản phẩm trong giỏ
     * Dùng cho phần "You Might Also Like"
     */
    public function getSuggestedProducts($limit = 4) {
        // Lấy ngẫu nhiên các sản phẩm khác để gợi ý
        $sql = "SELECT id, ten_san_pham, gia_ban, gia_khuyen_mai, anh_dai_dien, ma_sku 
                FROM san_pham 
                ORDER BY RAND() 
                LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}