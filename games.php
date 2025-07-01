<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>趣味游戏 - 中国古代物理科学</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/games.css">
</head>
<body>
    <?php include 'templates/nav.php'; ?>

    <header class="header">
        <div class="header-content">
            <h1 class="title">趣味游戏</h1>
            <p class="subtitle">寓教于乐 • 探索物理</p>
        </div>
    </header>

    <main class="main-content">
        <section class="games-section">
            <div class="game-cards">
                <!-- 活字印刷游戏卡片 -->
                <div class="game-card" onclick="location.href='#movable-type-game'">
                    <img src="source/images/games/movable-type.jpg" alt="活字印刷游戏">
                    <div class="game-info">
                        <h3>活字印刷填词</h3>
                        <p>体验活字印刷的乐趣，学习古代物理知识</p>
                    </div>
                </div>

                <!-- 物理消消乐游戏卡片 -->
                <div class="game-card" onclick="location.href='#physics-match'">
                    <img src="source/images/games/match-game.jpg" alt="物理消消乐">
                    <div class="game-info">
                        <h3>物理消消乐</h3>
                        <p>配对物理发明，了解科技历史</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 活字印刷游戏区域 -->
        <section id="movable-type-game" class="game-section">
            <h2>活字印刷填词游戏</h2>
            <div class="movable-type-container">
                <div class="word-bank"></div>
                <div class="printing-area"></div>
            </div>
            <div class="game-controls">
                <button id="check-answer">检查答案</button>
                <button id="reset-game">重新开始</button>
            </div>
        </section>

        <!-- 物理消消乐游戏区域 -->
        <section id="physics-match" class="game-section">
            <h2>物理消消乐</h2>
            <div class="match-game-container">
                <div class="game-grid"></div>
                <div class="game-info">
                    <p>分数: <span id="score">0</span></p>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2024 中国古代物理科学网站 | 联系我们</p>
    </footer>

    <script src="js/movable-type.js"></script>
    <script src="js/physics-match.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 测试图片是否存在
        const testImage = new Image();
        testImage.onload = function() {
            console.log('图片加载成功');
        };
        testImage.onerror = function() {
            console.error('图片加载失败');
        };
        testImage.src = 'source/images/achievements/didongyi.jpg';
    });
    </script>
</body>
</html> 