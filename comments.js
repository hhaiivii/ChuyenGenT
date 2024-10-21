document.addEventListener('DOMContentLoaded', () => {
    const commentForm = document.getElementById('comment-form');
    const commentText = document.getElementById('comment');
    const commentsSection = document.getElementById('comments-section');

    // Load comments when the page loads
    loadComments();

    // Handle comment submission
    commentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const comment = commentText.value.trim(); // Trim whitespace

        if (comment) {
            submitComment(comment);
            commentText.value = ''; // Clear the input field after submission
        } else {
            alert('Bình luận không được để trống.'); // Alert if the comment is empty
        }
    });

    function loadComments() {
        commentsSection.innerHTML = ''; // Clear existing comments
        fetch('load-comments.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể tải bình luận. Vui lòng thử lại sau.');
                }
                return response.json(); // Giả định dữ liệu trả về là JSON
            })
            .then(data => {
                data.forEach(comment => {
                    const p = document.createElement('p');
                    p.textContent = `${comment.username}: ${comment.text}`; // Hiển thị tên người dùng và bình luận
                    commentsSection.appendChild(p);
                });
            })
            .catch(error => {
                console.error('Lỗi:', error);
                commentsSection.innerHTML = '<p>Không thể tải bình luận. Vui lòng thử lại sau.</p>'; // Hiển thị thông báo lỗi
            });
    }

    function submitComment(comment) {
        fetch('submit-comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ comment }) // Gửi dữ liệu dưới dạng JSON
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Không thể gửi bình luận. Vui lòng thử lại sau.');
            }
            return response.json(); // Giả định phản hồi là JSON với thông điệp
        })
        .then(data => {
            alert(data.message); // Hiển thị thông báo từ phản hồi
            loadComments(); // Reload comments after successful submission
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Có lỗi xảy ra khi gửi bình luận. Vui lòng thử lại sau.');
        });
    }
});
