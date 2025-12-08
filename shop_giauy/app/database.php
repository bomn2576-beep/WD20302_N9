<?php
// DB.php
class DB {
    private static $instance = null;
    private $pdo;

    private $host = 'localhost';
    private $db_name = 'shop_giay'; 
    private $user = 'root'; 
    private $password = ''; 

    private function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (\PDOException $e) {
            // Chỉ ném lỗi, việc xử lý hiển thị lỗi sẽ được Controller/Test xử lý
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}