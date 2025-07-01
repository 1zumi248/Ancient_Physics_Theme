<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- 添加 Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<nav class="nav">
    <div class="nav-container">
        <div class="nav-links">
            <a href="/web/index.php">首页</a>
            <a href="/web/achievements.php">重要成就</a>
            <a href="/web/figures.php">历史人物</a>
            <a href="/web/documents.php">古籍文献</a>
            <a href="/web/games.php">趣味游戏</a>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
                <div class="admin-dropdown">
                    <button class="admin-dropbtn">管理功能 
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div class="admin-dropdown-content">
                        <a href="/web/admin/dashboard.php">用户管理</a>
                        <a href="/web/admin/comments.php">评论管理</a>
                        <a href="/web/admin/links.php">友情链接</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="auth-section">
            <?php if (isset($_SESSION['username'])): ?>
                <div class="user-info">
                    <span class="username-display">
                        <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
                            <i class="fas fa-crown admin-icon"></i>
                        <?php endif; ?>
                        欢迎，<?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                    <button onclick="handleLogout()" class="auth-btn">登出</button>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                    <a href="/web/php/login.php" class="auth-btn">登录</a>
                    <a href="/web/php/register.php" class="auth-btn">注册</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
function handleLogout() {
    fetch('/web/php/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // 重定向到主页面
                window.location.href = '/web/index.php';
            }
        })
        .catch(error => {
            console.error('登出错误:', error);
        });
}
</script> 