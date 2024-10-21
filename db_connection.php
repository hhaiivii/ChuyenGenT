<?php
$servername = "localhost"; // Địa chỉ máy chủ
$username = "your_username"; // Tên người dùng của bạn
$password = "your_password"; // Mật khẩu của bạn
$dbname = "your_database"; // Tên cơ sở dữ liệu

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
