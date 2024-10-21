<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = htmlspecialchars($_POST['comment']); // Lấy bình luận từ form và bảo mật
    
    // Mở file để ghi bình luận (hoặc lưu vào database nếu có)
    $file = fopen("comments.txt", "a");
    fwrite($file, $comment . "\n");
    fclose($file);

    echo "Bình luận đã được lưu thành công!";
} else {
    echo "Chỉ chấp nhận phương thức POST.";
}
?>
