// 页面滚动效果
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// 添加页面加载动画
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});

// 添加文档卡片点击事件
document.querySelectorAll('.document-card').forEach(card => {
    card.addEventListener('click', function() {
        // 可以添加查看详情的逻辑
        console.log('查看文献详情:', this.querySelector('h3').textContent);
    });
}); 