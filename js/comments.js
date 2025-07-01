// 评论处理函数
function addComment(btn) {
    const card = btn.closest('.moment-card');
    const input = card.querySelector('.comment-input input');
    const commentsList = card.querySelector('.comments-list');
    const text = input.value.trim();

    if (!text) {
        alert('请输入评论内容');
        return;
    }

    // 确保每个卡片都有唯一的 ID
    if (!card.id) {
        console.error('Card is missing ID attribute');
        alert('系统错误，请刷新页面重试');
        return;
    }

    // 创建 XMLHttpRequest 对象
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/web/php/comment_actions.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // 准备发送的数据
    const data = 'action=add' + 
                '&content=' + encodeURIComponent(text) + 
                '&pageId=' + encodeURIComponent(window.location.pathname) + 
                '&elementId=' + encodeURIComponent(card.id);

    // 添加调试信息
    console.log('Sending request with data:', data);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            // 添加调试信息
            console.log('Response status:', xhr.status);
            console.log('Response text:', xhr.responseText);
            
            try {
                const response = JSON.parse(xhr.responseText);
                console.log('Parsed response:', response);
                
                if (response.success) {
                    const comment = document.createElement('div');
                    comment.className = 'comment';
                    comment.innerHTML = '<strong>' + response.data.username + ':</strong> ' + 
                        response.data.content +
                        (response.data.isAdmin ? '<span class="delete-btn" onclick="deleteComment(this)" data-id="' + 
                        response.data.id + '"><i class="fas fa-trash-alt"></i></span>' : '');
                    
                    commentsList.appendChild(comment);
                    input.value = '';
                    comment.scrollIntoView({ behavior: 'smooth' });
                } else {
                    alert(response.message || '评论失败');
                }
            } catch (e) {
                console.error('解析响应失败:', e);
                console.error('原始响应:', xhr.responseText);
                alert('评论失败，请稍后重试');
            }
        }
    };

    xhr.onerror = function(e) {
        console.error('XHR error:', e);
        alert('网络错误，请稍后重试');
    };

    xhr.send(data);
}

// 删除评论函数
function deleteComment(btn) {
    if (!confirm('确定要删除这条评论吗？')) {
        return;
    }

    const commentId = btn.dataset.id;
    const comment = btn.closest('.comment');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/web/php/comment_actions.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    comment.style.opacity = '0';
                    comment.style.transform = 'translateX(20px)';
                    setTimeout(() => comment.remove(), 300);
                } else {
                    alert(response.message || '删除失败');
                }
            } catch (e) {
                console.error('解析响应失败:', xhr.responseText);
                alert('删除失败，请稍后重试');
            }
        }
    };

    xhr.onerror = function() {
        alert('网络错误，请稍后重试');
    };

    xhr.send('action=delete&commentId=' + encodeURIComponent(commentId));
}

function loadComments(card) {
    if (!card.id) {
        console.error('Card is missing ID attribute');
        return;
    }

    const commentsList = card.querySelector('.comments-list');
    const elementId = card.id;
    
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/web/php/comment_actions.php?action=get&pageId=' + 
        encodeURIComponent(window.location.pathname) + 
        '&elementId=' + encodeURIComponent(elementId), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    const comments = response.data.map(function(comment) {
                        return '<div class="comment">' +
                            '<strong>' + comment.username + ':</strong> ' + 
                            comment.content +
                            (window.isAdmin ? '<span class="delete-btn" onclick="deleteComment(this)" data-id="' + 
                            comment.id + '"><i class="fas fa-trash-alt"></i></span>' : '') +
                            '</div>';
                    }).join('');
                    commentsList.innerHTML = comments;
                }
            } catch (e) {
                console.error('解析响应失败:', xhr.responseText);
            }
        }
    };

    xhr.send();
}

// 页面加载时加载所有评论
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.moment-card').forEach(loadComments);
});

function toggleComments(btn) {
    const card = btn.closest('.moment-card');
    const commentsSection = card.querySelector('.comments-section');
    
    if (commentsSection.style.display === 'none') {
        commentsSection.style.display = 'block';
        commentsSection.style.opacity = '0';
        commentsSection.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            commentsSection.style.opacity = '1';
            commentsSection.style.transform = 'translateY(0)';
        }, 10);
    } else {
        commentsSection.style.opacity = '0';
        commentsSection.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            commentsSection.style.display = 'none';
        }, 300);
    }
} 