<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>趣味答题 - 中国古代物理科学</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>
    <?php include 'templates/nav.php'; ?>

    <header class="header">
        <div class="header-content">
            <h1 class="title">趣味答题</h1>
            <p class="subtitle">测试你的古代物理知识</p>
        </div>
    </header>

    <main class="main-content">
        <section class="section quiz-container">
            <div id="difficultySelector">
                <h2>选择难度</h2>
                <div class="difficulty-buttons">
                    <button class="btn" data-difficulty="easy">简单</button>
                    <button class="btn" data-difficulty="medium">中等</button>
                    <button class="btn" data-difficulty="hard">困难</button>
                </div>
            </div>

            <div id="timer" style="display: none;">
                剩余时间: <span id="timeLeft">60</span>秒
            </div>

            <div id="questionContainer"></div>

            <div id="result" class="result" style="display: none;">
                <h2>答题结束</h2>
                <p>你的得分: <span id="score">0</span></p>
                <button onclick="restartQuiz()" class="btn">重新开始</button>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2024 中国古代物理科学网站 | 联系我们</p>
    </footer>

    <script src="js/quiz.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 为所有难度按钮添加点击事件
            document.querySelectorAll('.difficulty-buttons .btn').forEach(button => {
                button.addEventListener('click', function() {
                    const difficulty = this.getAttribute('data-difficulty');
                    window.selectDifficulty(difficulty);
                });
            });
        });
    </script>
</body>
</html> 