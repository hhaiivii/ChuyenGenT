document.addEventListener('DOMContentLoaded', () => {
    const commentForm = document.getElementById('comment-form');
    const commentText = document.getElementById('comment-text');
    const commentsSection = document.getElementById('comments-section');

    // Load comments from cmt.txt
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
        fetch('cmt.txt')
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
        fetch('summit cmt', {
            method: 'POST',
            body: comment
        })
        .then(response => {
            if (response.ok) {
                loadComments(); // Reload comments after submission
            }
        });
    }
});
