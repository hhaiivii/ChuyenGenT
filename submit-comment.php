<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = htmlspecialchars($_POST['comment']); // Lấy bình luận và bảo mật

    // Mở file để ghi bình luận
    $file = fopen("comments.txt", "a");
    fwrite($file, $comment . "\n");
    fclose($file);

    // Chuyển hướng về lại trang chủ sau khi gửi bình luận
    header("Location: index.html");
    exit();
} else {
    echo "Chỉ chấp nhận phương thức POST.";
}
?>
