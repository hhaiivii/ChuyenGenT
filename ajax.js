function loadComments() {
    fetch('load-comments.php')
        .then(response => response.json())
        .then(data => {
            const commentsSection = document.getElementById('comments');
            commentsSection.innerHTML = '';
            data.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.innerHTML = `<strong>${comment.username}:</strong> ${comment.text}`;
                commentsSection.appendChild(commentDiv);
            });
        });
}

function submitComment() {
    const username = document.getElementById('username').value;
    const text = document.getElementById('comment-text').value;

    fetch('submit-comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, text }),
    })
    .then(response => response.text())
    .then(() => {
        loadComments();
    });
}
