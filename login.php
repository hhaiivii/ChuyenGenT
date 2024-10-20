<?php
session_start();
require 'db_connection.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        // Chuyển hướng đến trang chính hoặc trang cá nhân
        header("Location: index.php"); // Thay đổi đến trang chính của bạn
        exit();
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Đăng Nhập - Chuyện Gen T</title>
    <style>
        body {
            background: linear-gradient(135deg, #FF6F61, #FFC371);
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s, color 0.3s;
        }
        header {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            color: #FF6F61;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        main {
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #FF6F61;
            outline: none;
        }
        button {
            padding: 10px;
            margin-top: 10px;
            background-color: #FF6F61;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #FFC371;
        }
        p {
            text-align: center;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Đăng Nhập Tài Khoản</h1>
        <nav>
            <a href="index.html"><i class="fas fa-home"></i> Trang chủ</a>
            <a href="blog.html"><i class="fas fa-blog"></i> Blog</a>
            <a href="about.html"><i class="fas fa-info-circle"></i> Giới thiệu</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Đăng ký</a>
        </nav>
    </header>
    <main>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng Nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký tại đây</a></p>
    </main>
</body>
</html>
