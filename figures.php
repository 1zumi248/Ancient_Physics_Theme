<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>历史人物 - 中国古代物理科学</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/figures.css">
    <!-- <link rel="stylesheet" href="css/index.css"> -->
    <script>
        window.isAdmin = <?php echo isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] ? 'true' : 'false'; ?>;
    </script>
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

        <section id="figures" class="section">
            <h2>历史人物</h2>
            <div class="moments-container">
                <!-- 墨子的朋友圈 -->
                <div class="moment-card" id="moment-mozi">
                    <div class="moment-header">
                        <img src="source/images/scientist/mozi.jpg" alt="墨子" class="avatar">
                        <div class="user-info">
                            <h3>墨子</h3>
                            <span class="timestamp">战国时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>作为墨家学派创始人，我不仅是哲学家、政治家，更致力于物理学研究。我们墨家注重实践，在光学领域有重要发现，如小孔成像、光的直线传播等。记住我说的"光至影亡"！</p>
                        <div class="moment-images">
                            <img src="source/images/achievements/optics.jpg" alt="光学研究">
                        </div>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 沈括的朋友圈 -->
                <div class="moment-card" id="moment-shenkuo">
                    <div class="moment-header">
                        <img src="source/images/scientist/shenkuo.jpg" alt="沈括" class="avatar">
                        <div class="user-info">
                            <h3>沈括</h3>
                            <span class="timestamp">北宋时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>今日在《梦溪笔谈》中记录了一些有趣的物理现象，包括磁偏角、声音的传播等。这些发现对后世的物理学研究产生了重要影响。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 张衡的朋友圈 -->
                <div class="moment-card" id="moment-zhangheng">
                    <div class="moment-header">
                        <img src="source/images/scientist/zhangheng.jpg" alt="张衡" class="avatar">
                        <div class="user-info">
                            <h3>张衡</h3>
                            <span class="timestamp">东汉时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>今日完成了地动仪的制作！这个仪器能够测定地震的方向，是我多年研究的成果。除此之外，我还研究了力的平衡和杠杆原理，希望这些发明能够造福后世。</p>
                        <div class="moment-images">
                            <img src="source/images/achievements/didongyi.jpg" alt="地动仪">
                        </div>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 祖冲之的朋友圈 -->
                <div class="moment-card" id="moment-zuzhongzhi">
                    <div class="moment-header">
                        <img src="source/images/scientist/zuzhongzhi.jpg" alt="祖冲之" class="avatar">
                        <div class="user-info">
                            <h3>祖冲之</h3>
                            <span class="timestamp">南北朝时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>经过多年计算，终于将圆周率精确到了小数点后七位！同时，我对浮力和重力的研究也有了新的发现，这就是后人所说的"祖冲之定律"。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 一行朋友圈 -->
                <div class="moment-card" id="moment-yixing">
                    <div class="moment-header">
                        <img src="source/images/scientist/yixing.jpg" alt="一行" class="avatar">
                        <div class="user-info">
                            <h3>一行</h3>
                            <span class="timestamp">唐朝时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>今日完成了地球子午线的测量工作，这是世界上第一次如此精确的测量！除此之外，我还在研究光学和机械，正在制作新的天文仪器。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 郭守敬的朋友圈 -->
                <div class="moment-card" id="moment-guoshoujing">
                    <div class="moment-header">
                        <img src="source/images/scientist/guoshoujing.jpg" alt="郭守" class="avatar">
                        <div class="user-info">
                            <h3>郭守敬</h3>
                            <span class="timestamp">元朝时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>近期创制了简仪、高标等近二十件天文观测仪器，同时对历法进行了改革。我对圆周率的计算也取得了突破，是目前世界最精确的结果！</p>
                        <div class="moment-images">
                            <img src="source/images/achievements/jianyi.jpg" alt="简仪">
                        </div>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 赵友钦的朋友圈 -->
                <div class="moment-card" id="moment-zhaoyouqin">
                    <div class="moment-header">
                        <img src="source/images/scientist/zhaoyouqin.jpg" alt="赵友钦" class="avatar">
                        <div class="user-info">
                            <h3>赵友钦</h3>
                            <span class="timestamp">南宋时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>最近进行了一系列光学实验，包括小孔成像、凹凸面镜成像等。我对成像原理进行了详细分析，这些研究将为光学发展奠定基础。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 宋应星的朋友圈 -->
                <div class="moment-card" id="moment-songyingxing">
                    <div class="moment-header">
                        <img src="source/images/scientist/songyingxing.jpg" alt="宋应星" class="avatar">
                        <div class="user-info">
                            <h3>宋应星</h3>
                            <span class="timestamp">明朝时期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>《天工开物》终于完成了！书中详细记录了各种机械原理和制造技术，涵盖了力学、声学、磁学等多个领域的知识。希望这些技术能够帮助更多人。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 王锡阐的朋友圈 -->
                <div class="moment-card" id="moment-wangxichan">
                    <div class="moment-header">
                        <img src="source/images/scientist/wangxichan.jpg" alt="王锡阐" class="avatar">
                        <div class="user-info">
                            <h3>王锡阐</h3>
                            <span class="timestamp">明末清初</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>除了研究天文现象，我还深入研究了物理学中的诸多问题。特别是在光的折射、反射等方面有了新的发现。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 郑复光的朋友圈 -->
                <div class="moment-card" id="moment-zhengfuguang">
                    <div class="moment-header">
                        <img src="source/images/scientist/zhengfuguang.jpg" alt="郑复光" class="avatar">
                        <div class="user-info">
                            <h3>郑复光</h3>
                            <span class="timestamp">清代中期</span>
                        </div>
                    </div>
                    <div class="moment-content">
                        <p>最近完成了《镜镜詅痴》的撰写，书中详细讨论了各种反射镜和折射镜的制造方法，以及光线的反射和折射原理。我在《费隐于知录》中提出的"郑氏光学理论"，对光的直线传播、反射、折射、全反射等现象都进行了解释。</p>
                    </div>
                    <div class="moment-actions">
                        <button class="like-btn" onclick="handleLike(this)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>0</span>
                        </button>
                        <button class="comment-btn" onclick="toggleComments(this)">
                            <i class="fas fa-comment"></i>
                            评论
                        </button>
                    </div>
                    <div class="comments-section" style="display: none;">
                        <div class="comments-list"></div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="comment-input">
                                <input type="text" placeholder="写下你的评论...">
                                <button onclick="addComment(this)">发送</button>
                            </div>
                        <?php else: ?>
                            <div class="login-prompt">
                                <p>请<a href="/web/php/login.php">登录</a>后发表评论</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2024 中国古代物理科学网站 | 联系我们</p>
    </footer>
    
    <script src="js/likes.js"></script>
    <script src="js/comments.js"></script>
</body>
</html> 