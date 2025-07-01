<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>古籍文献 - 中国古代物理科学</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/documents.css">
</head>
<body>
    <?php include 'templates/nav.php'; ?>

    <header class="header">
        <div class="header-content">
            <h1 class="title">古籍文献</h1>
            <p class="subtitle">探索华夏智慧 • 传承科技文明</p>
        </div>
    </header>

    <main class="main-content">
        <section class="section">
            <h2>重要典籍</h2>
            <div class="document-grid">
                <div class="document-card">
                    <h3><a href="https://baike.baidu.com/item/墨经" target="_blank">《墨经》</a></h3>
                    <p>记载了墨家在光学、力学等方面的重要发现和理论。包含"光至影亡"等重要物理学观点。</p>
                    <div class="document-info">
                        <span class="time">战国时期</span>
                        <span class="category">物理学著作</span>
                    </div>
                </div>

                <div class="document-card">
                    <h3><a href="https://baike.baidu.com/item/梦溪笔谈" target="_blank">《梦溪笔谈》</a></h3>
                    <p>沈括撰写，记录了磁偏角、声学现象等重要物理发现，是宋代重要的科技著作。</p>
                    <div class="document-info">
                        <span class="time">北宋时期</span>
                        <span class="category">科学笔记</span>
                    </div>
                </div>

                <div class="document-card">
                    <h3><a href="https://baike.baidu.com/item/天工开物" target="_blank">《天工开物》</a></h3>
                    <p>宋应星撰写，系统记录了明代科学技术成就，包含多项物理学原理应用。</p>
                    <div class="document-info">
                        <span class="time">明朝时期</span>
                        <span class="category">科技著作</span>
                    </div>
                </div>

                <div class="document-card">
                    <h3><a href="https://baike.baidu.com/item/镜镜詅痴" target="_blank">《镜镜詅痴》</a></h3>
                    <p>郑复光撰写，详细讨论了光学理论和镜子制造技术，是重要的光学著作。</p>
                    <div class="document-info">
                        <span class="time">清代中期</span>
                        <span class="category">光学专著</span>
                    </div>
                </div>

                <div class="document-card">
                    <h3><a href="https://baike.baidu.com/item/武编" target="_blank">《武编》</a></h3>
                    <p>记载了投石机等军事装置的制造原理，体现了力学原理的实际应用。</p>
                    <div class="document-info">
                        <span class="time">宋代</span>
                        <span class="category">军事技术</span>
                    </div>
                </div>

                <div class="document-card">
                    <h3><a href="https://baike.baidu.com/item/律吕新书" target="_blank">《律吕新书》</a></h3>
                    <p>蔡元定撰写，系统研究声学理论和音律，展现了古人对声学的深入认识。</p>
                    <div class="document-info">
                        <span class="time">南宋时期</span>
                        <span class="category">声学著作</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2024 中国古代物理科学网站 | 联系我们</p>
    </footer>
</body>
</html> 