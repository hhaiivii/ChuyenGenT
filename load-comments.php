<?php
    // Đường dẫn đến file chứa các bình luận
    $filePath = 'cmt.txt';

    // Kiểm tra xem file có tồn tại không
    if (file_exists($filePath)) {
        // Đọc nội dung của file
        $comments = file_get_contents($filePath);
        // Trả về nội dung của file dưới dạng plain text
        header('Content-Type: text/plain');
        echo $comments;
    } else {
        // Nếu file không tồn tại, trả về thông báo lỗi
        header('Content-Type: text/plain');
        echo "No comments yet.";
    }
?>
