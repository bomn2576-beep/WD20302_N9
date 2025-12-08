<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "shop_giay"; // ĐÃ SỬA TÊN DATABASE TỪ 'shop'

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Lỗi kết nối: " . $conn->connect_error);
}
?>