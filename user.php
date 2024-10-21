<?php
// user.php
require 'db_connection.php';

function createUser($username, $password) {
    global $conn;

    // Kiểm tra tính hợp lệ của tên người dùng
    if (empty($username) || empty($password) || strlen($username) < 3 || strlen($password) < 6) {
        return [
            'success' => false,
            'message' => "Tên đăng nhập phải có ít nhất 3 ký tự và mật khẩu phải có ít nhất 6 ký tự."
        ];
    }

    try {
        // Kiểm tra xem người dùng đã tồn tại
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            return [
                'success' => false,
                'message' => "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác."
            ];
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Sử dụng prepared statements để tránh SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        
        if ($stmt->execute([$username, $hashedPassword])) {
            return [
                'success' => true,
                'message' => "Tạo tài khoản thành công."
            ];
        } else {
            return [
                'success' => false,
                'message' => "Không thể tạo tài khoản, vui lòng thử lại."
            ];
        }
    } catch (PDOException $e) {
        // Xử lý lỗi cơ sở dữ liệu
        return [
            'success' => false,
            'message' => "Đã xảy ra lỗi: " . $e->getMessage()
        ];
    }
}

function getUser($username) {
    global $conn;

    try {
        // Sử dụng prepared statements để tránh SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            return [
                'success' => true,
                'user' => $user
            ];
        } else {
            return [
                'success' => false,
                'message' => "Người dùng không tồn tại."
            ];
        }
    } catch (PDOException $e) {
        // Xử lý lỗi cơ sở dữ liệu
        return [
            'success' => false,
            'message' => "Đã xảy ra lỗi: " . $e->getMessage()
        ];
    }
}
?>
