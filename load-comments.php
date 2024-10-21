<?php
// Đường dẫn đến file chứa các bình luận
$filePath = 'cmt.txt';

// Kiểm tra xem file có tồn tại không
if (file_exists($filePath)) {
    // Đọc nội dung của file
    $comments = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Trả về nội dung của file dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'comments' => $comments
    ]);
} else {
    // Nếu file không tồn tại, trả về thông báo lỗi
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => "Chưa có bình luận nào."
    ]);
}
?>
