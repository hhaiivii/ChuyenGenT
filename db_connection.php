<?php
$servername = "localhost"; // Địa chỉ máy chủ
$username = "your_username"; // Tên người dùng của bạn
$password = "your_password"; // Mật khẩu của bạn
$dbname = "your_database"; // Tên cơ sở dữ liệu

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    // Thay vì die, có thể trả về thông báo lỗi dưới dạng JSON
    http_response_code(500); // Lỗi máy chủ
    echo json_encode([
        'success' => false,
        'message' => 'Kết nối thất bại: ' . $conn->connect_error
    ]);
    exit();
}

// Thiết lập chế độ báo lỗi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Tùy chọn thiết lập charset
$conn->set_charset("utf8mb4"); // Thiết lập charset cho cơ sở dữ liệu

// Đóng kết nối khi không cần thiết
// $conn->close(); // Mở dòng này nếu muốn tự động đóng kết nối khi không cần
?>
