<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra nếu 'comment' có tồn tại trong yêu cầu POST
    if (isset($_POST['comment']) && !empty(trim($_POST['comment']))) {
        // Lấy bình luận và bảo mật
        $comment = htmlspecialchars(trim($_POST['comment']));

        // Đường dẫn tới file lưu bình luận
        $filePath = 'cmt.txt';

        // Mở file để ghi bình luận
        if (file_put_contents($filePath, $comment . PHP_EOL, FILE_APPEND | LOCK_EX) !== false) {
            // Trả về phản hồi thành công
            http_response_code(200);
            echo json_encode(["message" => "Bình luận đã được gửi thành công."]);
        } else {
            // Trả về lỗi nếu không ghi được file
            http_response_code(500);
            echo json_encode(["error" => "Không thể ghi bình luận. Vui lòng thử lại sau."]);
        }
    } else {
        // Nếu bình luận rỗng hoặc không hợp lệ
        http_response_code(400);
        echo json_encode(["error" => "Bình luận không được để trống."]);
    }
} else {
    // Chỉ chấp nhận phương thức POST
    http_response_code(405);
    echo json_encode(["error" => "Chỉ chấp nhận phương thức POST."]);
}
?>
