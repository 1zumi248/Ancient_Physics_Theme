<?php
session_start();
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit;
}

require_once '../php/con_mysql.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>友情链接管理 - 中国古代物理科学</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php include '../templates/nav.php'; ?>

    <main class="main-content">
        <section class="section">
            <h2>友情链接管理</h2>
            
            <div class="links-section">
                <h3>主题相关网站</h3>
                <ul class="admin-links-list">
                    <li>
                        <span class="link-title">中国科学院自然科学史研究所</span>
                        <span class="link-url">https://www.ihns.cas.cn/</span>
                        <span class="link-desc">中国科学史研究的权威机构</span>
                    </li>
                    <li>
                        <span class="link-title">中国国家博物馆</span>
                        <span class="link-url">http://www.chnmuseum.cn/</span>
                        <span class="link-desc">收藏大量古代科技文物</span>
                    </li>
                    <li>
                        <span class="link-title">中国国家图书馆</span>
                        <span class="link-url">http://www.nlc.cn/</span>
                        <span class="link-desc">馆藏丰富的古籍文献</span>
                    </li>
                    <li>
                        <span class="link-title">百度百科</span>
                        <span class="link-url">https://baike.baidu.com/</span>
                        <span class="link-desc">为详细了解文献提供支持</span>
                    </li>
                </ul>
            </div>

            <div class="links-section">
                <h3>参考资料</h3>
                <ul class="admin-links-list">
                    <li>
                        <span class="link-title">中国科技史料</span>
                        <span class="link-url">http://www.ihns.cas.cn/kxjs/zgkjsl/</span>
                        <span class="link-desc">科技史研究资料库</span>
                    </li>
                    <li>
                        <span class="link-title">中国古代科技文明</span>
                        <span class="link-url">http://www.keji.cas.cn/cxz/</span>
                        <span class="link-desc">科普教育资源</span>
                    </li>
                </ul>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2024 中国古代物理科学网站 | 联系我们</p>
    </footer>
</body>
</html> 