<?php
// app/config/database.php

function getConnection() {
    $host = "localhost";
    $db_name = "wd20302_n9_local";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Thiết kế để trả về kết nối chuẩn UTF-8
        $conn->exec("set names utf8");
        return $conn;
    } catch(PDOException $exception) {
        echo "Lỗi kết nối: " . $exception->getMessage();
        return null;
    }
}
?>