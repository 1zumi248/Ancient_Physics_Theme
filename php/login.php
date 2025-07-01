<?php
// 设置字符编码
header('Content-Type: text/html; charset=utf-8');
session_start();

// 包含数据库连接配置
require 'con_mysql.php';

// 初始化消息变量
$message = '';

// 检查是否是POST请求（即用户提交了表单）
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取并清理输入的数据
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 管理员登录判断
    if ($username === 'admin' && $password === 'admin23') {
        $_SESSION['username'] = 'admin';
        $_SESSION['isAdmin'] = true;
        header('Location: ../admin/dashboard.php');
        exit;
    }

    try {
        // 首先只检查用户名
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // 检查是否被封禁
            if (isset($user['banned_until']) && $user['banned_until'] !== null && strtotime($user['banned_until']) > time()) {
                $message = "账号已被封禁至 " . $user['banned_until'];
            }
            // 验证密码
            elseif ($user['password'] === $password) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['isAdmin'] = false;
                header('Location: ../index.php');
                exit;
            } else {
                $message = "密码错误";
            }
        } else {
            $message = "用户名不存在";
        }
    } catch (PDOException $e) {
        $message = "数据库错误：" . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background: url('../source/back.jpg') no-repeat center center fixed; /* 使用一个古代风格的背景图片 */
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .login-container {
            width: 360px;
            margin: 100px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8); /* 半透明白色背景 */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #7a4b00;
            font-size: 2em;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #7a4b00;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #5a3b00;
        }
        p {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h2>用户登录</h2>
            <label for="username">用户名:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密码:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">登录</button>
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>