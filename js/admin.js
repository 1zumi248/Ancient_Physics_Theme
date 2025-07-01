// 重置密码
document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    handleAdminAction('reset_password', this);
});

// 添加用户
document.getElementById('addUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    handleAdminAction('add_user', this);
});

// 封禁用户
document.getElementById('banUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    handleAdminAction('ban_user', this);
});

// 注销用户
document.getElementById('deleteUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    handleAdminAction('delete_user', this);
});

function handleAdminAction(action, form) {
    const formData = new FormData(form);
    formData.append('action', action);

    // 添加调试信息
    console.log('Sending request to admin_actions.php');
    console.log('Action:', action);
    console.log('Form data:', Object.fromEntries(formData));

    fetch('../php/admin_actions.php', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(async response => {
        console.log('Response status:', response.status);
        const text = await response.text();
        console.log('Raw response:', text);
        
        try {
            return JSON.parse(text);
        } catch (e) {
            console.error('JSON parse error:', e);
            console.error('Response text:', text);
            throw new Error('Invalid JSON response');
        }
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            alert(data.message || '操作成功！');
            form.reset();
        } else {
            alert(data.message || '操作失败！');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('操作失败，请检查控制台获取详细错误信息。');
    });
}

// 确保所有表单都正确绑定了事件处理器
document.addEventListener('DOMContentLoaded', function() {
    const forms = {
        'resetPasswordForm': 'reset_password',
        'addUserForm': 'add_user',
        'banUserForm': 'ban_user',
        'deleteUserForm': 'delete_user',
        'unbanUserForm': 'unban_user',
        'changePasswordForm': 'change_password'
    };

    for (const [formId, action] of Object.entries(forms)) {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log(`Handling ${action} action from form ${formId}`);
                handleAdminAction(action, this);
            });
        } else {
            console.error(`Form with id ${formId} not found!`);
        }
    }
});