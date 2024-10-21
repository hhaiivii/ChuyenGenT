<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Giả sử bạn đã kết nối với cơ sở dữ liệu
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $username;
        header("Location: index.html");
    } else {
        echo "Sai tên đăng nhập hoặc mật khẩu.";
    }
}
?>
