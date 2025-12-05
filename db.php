<?php
$conn = mysqli_connect("localhost", "root", "", "shop_giay");
mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("Kết nối thất bại!");
}
?>
