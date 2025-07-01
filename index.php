<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中国古代物理科学</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'templates/nav.php'; ?>
    
    <header class="header">
        <div class="header-content">
            <h1 class="title">中国古代物理科学</h1>
            <p class="subtitle">探索华夏智慧 • 传承科技文明</p>
        </div>
    </header>

    <main class="main-content">
        <section id="history" class="section">
            <h2>历史渊源</h2>
            <p>中国古代物理科学发展历史悠久，从先秦到明清，历经数千年的积累与发展。古代先民们通过观察自然现象，进行各种实践活动，积累了丰富的物理知识。</p>
            <div class="timeline">
                <div class="timeline-item">
                    <h3>先秦时期</h3>
                    <p>墨家学派发展光学、力学理论，提出"光至影亡"等重要观点。</p>
                </div>
                <div class="timeline-item">
                    <h3>汉唐时期</h3>
                    <p>张衡发明地动仪，一行和尚测量子午线，科技发展进入黄金时期。</p>
                </div>
                <div class="timeline-item">
                    <h3>宋元时期</h3>
                    <p>沈括记录磁偏角，郭守敬改革历法，物理研究更加系统化。</p>
                </div>
                <div class="timeline-item">
                    <h3>明清时期</h3>
                    <p>王锡阐、郑复光等人在光学领域取得重要突破。</p>
                </div>
            </div>
        </section>

        <section id="achievements" class="section">
            <h2>重要成就</h2>
            <div class="article-grid">
                <div class="article-card">
                    <img src="source/images/achievements/didongyi.jpg" alt="机械工程">
                    <h3>机械工程</h3>
                    <p>张衡地动仪、指南车、浑天仪等重要发明，展现了古人对机械原理的深刻理解。</p>
                </div>
                <div class="article-card">
                    <img src="source/images/achievements/optics.jpg" alt="光学发展">
                    <h3>光学发展</h3>
                    <p>墨子小孔成像、镜子制造等光学研究，奠定了中国古代光学的基础。</p>
                </div>
                <div class="article-card">
                    <img src="source/images/achievements/bianzhong.jpg" alt="声学研究">
                    <h3>声学研究</h3>
                    <p>编钟制作技术、音律理论等声学成就，体现了对声音传播规律的认识。</p>
                </div>
            </div>
            <div class="section-footer">
                <a href="achievements.php" class="more-link">查看更多成就</a>
            </div>
        </section>

        <section id="figures" class="section">
            <h2>杰出人物</h2>
            <div class="figures-grid">
                <div class="figure-card">
                    <img src="source/images/scientist/mozi.jpg" alt="墨子">
                    <h3>墨子</h3>
                    <p>战国时期物理学家，在光学、力学等方面有重要贡献。</p>
                </div>
                <div class="figure-card">
                    <img src="source/images/scientist/zhangheng.jpg" alt="张衡">
                    <h3>张衡</h3>
                    <p>东汉时期科学家，发明地动仪，研究天文历法。</p>
                </div>
                <div class="figure-card">
                    <img src="source/images/scientist/shenkuo.jpg" alt="沈括">
                    <h3>沈括</h3>
                    <p>北宋科学家，记录磁偏角现象，著有《梦溪笔谈》。</p>
                </div>
            </div>
            <div class="section-footer">
                <a href="figures.php" class="more-link">查看更多历史人物</a>
            </div>
        </section>

        <section id="documents" class="section">
            <h2>古籍文献</h2>
            <div class="documents-preview">
                <div class="document-item">
                    <h3>《墨经》</h3>
                    <p>记载了墨家在物理学方面的重要发现和理论。</p>
                </div>
                <div class="document-item">
                    <h3>《梦溪笔谈》</h3>
                    <p>详细记录了宋代的科学技术成就。</p>
                </div>
                <div class="document-item">
                    <h3>《天工开物》</h3>
                    <p>系统介绍了明代的科学技术发展。</p>
                </div>
            </div>
            <div class="section-footer">
                <a href="documents.php" class="more-link">浏览更多古籍文献</a>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>快速链接</h3>
                <ul>
                    <li><a href="#history">历史渊源</a></li>
                    <li><a href="#achievements">重要成就</a></li>
                    <li><a href="figures.php">历史人物</a></li>
                    <li><a href="documents.php">古籍文献</a></li>
                </ul>
        <div class="footer-bottom">
            <p>© 2024 中国古代物理科学网站 | 保留所有权利</p>
        </div>
    </footer>
</body>
</html> 