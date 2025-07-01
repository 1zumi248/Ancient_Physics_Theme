<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重要成就 - 中国古代物理科学</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/achievements.css">
</head>
<body>
    <?php include 'templates/nav.php'; ?>

    <header class="header">
        <div class="header-content">
            <h1 class="title">重要成就</h1>
            <p class="subtitle">探索华夏智慧 • 传承科技文明</p>
        </div>
    </header>

    <main class="main-content">
        <section class="section">
            <h2>机械工程</h2>
            <div class="achievement-grid">
                <div class="achievement-card">
                    <img src="source/images/achievements/didongyi.jpg" alt="地动仪">
                    <div class="achievement-content">
                        <h3>地动仪</h3>
                        <p>张衡发明的地动仪是世界上第一台地震仪，能够测定地震发生的方向。</p>
                        <button class="read-more" onclick="showAchievementDetail('didongyi')">了解更多</button>
                    </div>
                </div>
                <div class="achievement-card">
                    <img src="source/images/achievements/zhinanche.jpg" alt="指南车">
                    <div class="achievement-content">
                        <h3>指南车</h3>
                        <p>利用差动齿轮原理制造的机械导航装置，是中国古代重要的发明之一。</p>
                        <button class="read-more" onclick="showAchievementDetail('zhinanche')">了解更多</button>
                    </div>
                </div>
                <div class="achievement-card">
                    <img src="source/images/achievements/huntianyi.jpg" alt="浑天仪">
                    <div class="achievement-content">
                        <h3>浑天仪</h3>
                        <p>天文观测仪器，采用精密的机械传动装置，用于观测天体运动。</p>
                        <button class="read-more" onclick="showAchievementDetail('huentianyi')">了解更多</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>光学成就</h2>
            <div class="achievement-grid">
                <div class="achievement-card">
                    <img src="source/images/achievements/optics.jpg" alt="小孔成像">
                    <div class="achievement-content">
                        <h3>小孔成像</h3>
                        <p>墨子最早发现并记录了小孔成像现象，提出"光至影亡"等重要观点。</p>
                        <button class="read-more" onclick="showAchievementDetail('optics')">了解更多</button>
                    </div>
                </div>
                <div class="achievement-card">
                    <img src="source/images/achievements/tongjing.jpg" alt="镜子制造">
                    <div class="achievement-content">
                        <h3>镜子制造</h3>
                        <p>郑复光在《镜镜詅痴》中详细记录了各种反射镜和折射镜的制造方法。</p>
                        <button class="read-more" onclick="showAchievementDetail('mirror')">了解更多</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>声学成就</h2>
            <div class="achievement-grid">
                <div class="achievement-card">
                    <img src="source/images/achievements/bianzhong.jpg" alt="编钟技术">
                    <div class="achievement-content">
                        <h3>编钟技术</h3>
                        <p>古代工匠掌握了精确的音律计算和青铜冶炼技术，制造出音色优美的编钟。</p>
                        <button class="read-more" onclick="showAchievementDetail('bianzhong')">了解更多</button>
                    </div>
                </div>
                <div class="achievement-card">
                    <img src="source/images/achievements/sound.jpg" alt="声学理论">
                    <div class="achievement-content">
                        <h3>声学理论</h3>
                        <p>沈括在《梦溪笔谈》中记录了声音反射等声学现象的观察。而天坛则是完美利用了该原理</p>
                        <button class="read-more" onclick="showAchievementDetail('acoustics')">了解更多</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- 成就详情弹窗 -->
    <div id="achievementModal" class="achievement-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body" id="modalContent"></div>
        </div>
    </div>

    <footer class="footer">
        <p>© 2024 中国古代物理科学网站 | 联系我们</p>
    </footer>

    <script src="js/achievements.js"></script>
</body>
</html> 