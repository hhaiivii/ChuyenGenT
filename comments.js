document.addEventListener('DOMContentLoaded', () => {
    const commentForm = document.getElementById('comment-form');
    const commentText = document.getElementById('comment');
    const commentsSection = document.getElementById('comments-section');

    // Load comments from PHP
    loadComments();

    // Handle comment submission
    commentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const comment = commentText.value;

        if (comment) {
            submitComment(comment);
            commentText.value = '';
        }
    });

    function loadComments() {
        commentsSection.innerHTML = ''; // Xóa các bình luận cũ
        fetch('load-comments.php')
            .then(response => response.text())
            .then(data => {
                const comments = data.split('\n');
                comments.forEach(comment => {
                    if (comment) {
                        const p = document.createElement('p');
                        p.textContent = comment;
                        commentsSection.appendChild(p);
                    }
                });
            });
    }

    function submitComment(comment) {
        // Gửi yêu cầu đến server để thêm bình luận vào cmt.txt
        fetch('submit-comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `comment=${encodeURIComponent(comment)}`
        })
        .then(response => {
            if (response.ok) {
                loadComments(); // Reload comments after submission
            }
        });
    }
});
