// auth.js
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Lấy dữ liệu từ form
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Gửi yêu cầu đăng nhập đến server
    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'index.html'; // Chuyển hướng sau khi đăng nhập thành công
        } else {
            alert(data.message); // Hiển thị thông báo lỗi
        }
    });
});

// Tương tự cho đăng ký
document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('reg-username').value;
    const password = document.getElementById('reg-password').value;

    fetch('register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'login.html'; // Chuyển hướng đến trang đăng nhập
        } else {
            alert(data.message);
        }
    });
});
