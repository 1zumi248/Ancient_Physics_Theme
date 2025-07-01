// 处理登录表单提交
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/web/php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal('loginModal');
            window.location.reload();
        } else {
            alert(data.message);
        }
    });
});

// 处理注册表单提交
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    if (formData.get('password') !== formData.get('confirmPassword')) {
        alert('两次输入的密码不一致');
        return;
    }

    fetch('/web/php/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal('registerModal');
            window.location.reload();
        } else {
            alert(data.message);
        }
    });
});

// 处理登出
function handleLogout() {
    fetch('/web/php/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
}

// 模态框控制
function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function switchModal(closeModalId, openModalId) {
    closeModal(closeModalId);
    showModal(openModalId);
} 