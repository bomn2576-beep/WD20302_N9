<?php
class CategoryModel {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM danh_muc ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertCategory($name) {
        $sql = "INSERT INTO danh_muc (ten_danh_muc) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM danh_muc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}