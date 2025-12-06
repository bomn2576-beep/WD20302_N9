<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "shop";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Lỗi kết nối: " . $conn->connect_error);
}
?>
