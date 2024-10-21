// Chức năng bình luận
const commentForm = document.getElementById('comment-form');
const commentsList = document.getElementById('comments-list');

// Tải bình luận từ localStorage khi trang được tải
document.addEventListener('DOMContentLoaded', loadComments);

commentForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const comment = document.getElementById('comment').value;
    addComment(username, comment);
    saveComment(username, comment); // Lưu bình luận vào localStorage
    commentForm.reset();
});

function addComment(username, comment) {
    const li = document.createElement('li');
    li.innerHTML = `<strong>${username}</strong>: ${comment} <div class="comment-meta">${new Date().toLocaleString()}</div>
    <div class="comment-actions">
        <button class="edit-button">Chỉnh sửa</button>
        <button class="delete-button">Xóa</button>
    </div>`;
    commentsList.appendChild(li);

    // Chức năng xóa bình luận
    li.querySelector('.delete-button').addEventListener('click', function() {
        li.remove();
        removeCommentFromStorage(username, comment); // Xóa khỏi localStorage
    });

    // Chức năng chỉnh sửa bình luận
    li.querySelector('.edit-button').addEventListener('click', function() {
        const newComment = prompt('Chỉnh sửa bình luận:', comment);
        if (newComment) {
            comment = newComment;
            li.childNodes[0].textContent = username + ": " + comment;
            updateCommentInStorage(username, newComment); // Cập nhật trong localStorage
        }
    });
}

// Hàm lưu bình luận vào localStorage
function saveComment(username, comment) {
    const comments = JSON.parse(localStorage.getItem('comments')) || [];
    comments.push({ username, comment, timestamp: new Date().toLocaleString() });
    localStorage.setItem('comments', JSON.stringify(comments));
}

// Hàm tải bình luận từ localStorage
function loadComments() {
    const comments = JSON.parse(localStorage.getItem('comments')) || [];
    comments.forEach(commentData => {
        addComment(commentData.username, commentData.comment);
    });
}

// Hàm xóa bình luận khỏi localStorage
function removeCommentFromStorage(username, comment) {
    let comments = JSON.parse(localStorage.getItem('comments')) || [];
    comments = comments.filter(c => !(c.username === username && c.comment === comment));
    localStorage.setItem('comments', JSON.stringify(comments));
}

// Hàm cập nhật bình luận trong localStorage
function updateCommentInStorage(username, newComment) {
    const comments = JSON.parse(localStorage.getItem('comments')) || [];
    const commentIndex = comments.findIndex(c => c.username === username);
    if (commentIndex !== -1) {
        comments[commentIndex].comment = newComment;
        localStorage.setItem('comments', JSON.stringify(comments));
    }
}
