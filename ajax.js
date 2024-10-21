function loadComments() {
    fetch('load-comments.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Mất kết nối với máy chủ.');
            }
            return response.json();
        })
        .then(data => {
            const commentsSection = document.getElementById('comments');
            commentsSection.innerHTML = ''; // Xóa nội dung cũ
            data.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment'); // Thêm lớp cho bình luận
                commentDiv.innerHTML = `<strong>${comment.username}:</strong> ${comment.text}`;
                commentsSection.appendChild(commentDiv);
            });
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
            const commentsSection = document.getElementById('comments');
            commentsSection.innerHTML = `<p>Không thể tải bình luận. Vui lòng thử lại sau.</p>`;
        });
}

function submitComment() {
    const username = document.getElementById('username').value.trim();
    const text = document.getElementById('comment-text').value.trim();

    if (!username || !text) {
        alert('Tên đăng nhập và bình luận không được để trống.');
        return;
    }

    fetch('submit-comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, text }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Có lỗi xảy ra khi gửi bình luận.');
        }
        return response.json();
    })
    .then(data => {
        alert(data.message); // Hiển thị thông báo thành công
        loadComments(); // Tải lại bình luận
        document.getElementById('comment-text').value = ''; // Xóa nội dung bình luận sau khi gửi
    })
    .catch(error => {
        console.error('Có lỗi xảy ra:', error);
        alert('Không thể gửi bình luận. Vui lòng thử lại sau.');
    });
}

