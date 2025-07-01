// 更新点赞处理函数
function handleLike(btn) {
    const countSpan = btn.querySelector('span');
    let count = parseInt(countSpan.textContent);
    
    // 添加动画类
    btn.classList.add('animate');
    
    // 更新点赞状态和数量
    if (!btn.classList.contains('liked')) {
        count++;
        btn.classList.add('liked');
    } else {
        count--;
        btn.classList.remove('liked');
    }
    
    countSpan.textContent = count;
    
    // 动画结束后移除动画类
    setTimeout(() => {
        btn.classList.remove('animate');
    }, 500);
} 