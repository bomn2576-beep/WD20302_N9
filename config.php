<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "shop_giay"; // Đảm bảo tên DB chính xác

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Lỗi kết nối: " . $conn->connect_error);
}
?>