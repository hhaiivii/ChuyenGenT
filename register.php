<?php
session_start();
require 'db_connection.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu

    // Kiểm tra xem người dùng đã tồn tại chưa
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Tên đăng nhập đã tồn tại.";
    } else {
        // Thêm người dùng mới
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            echo "Đăng ký thành công!";
        } else {
            echo "Có lỗi xảy ra.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
</head>
<body>
    <h2>Đăng Ký</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Tên đăng nhập" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng ký</button>
    </form>
    <p>Đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a></p>
</body>
</html>
