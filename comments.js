function submitComment(comment) {
    // Gửi yêu cầu đến server để thêm bình luận vào comments.txt
    fetch('summit-comment.php', { // Đường dẫn đến file PHP
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ comment: comment }) // Gửi bình luận
    })
    .then(response => {
        if (response.ok) {
            loadComments(); // Reload comments after submission
        }
    });
}
