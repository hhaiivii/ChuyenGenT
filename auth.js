// auth.js

// Đăng nhập
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
    .then(response => {
        if (!response.ok) {
            throw new Error('Lỗi khi gửi yêu cầu đăng nhập.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = 'index.html'; // Chuyển hướng sau khi đăng nhập thành công
        } else {
            alert(data.message); // Hiển thị thông báo lỗi
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
    });
});

// Đăng ký
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
    .then(response => {
        if (!response.ok) {
            throw new Error('Lỗi khi gửi yêu cầu đăng ký.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = 'login.html'; // Chuyển hướng đến trang đăng nhập
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
    });
});
