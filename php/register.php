<?php
// register.php
header('Content-Type: text/html; charset=utf-8');
// 启动会话
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
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;

    // 验证输入（这里省略具体的验证逻辑）

    // 检查用户名是否已存在
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $message = "用户名已存在，请选择其他用户名。";
    } else {
        // 对密码进行哈希处理
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 插入新的用户记录
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $email])) {
            $_SESSION['message'] = "注册成功！";
            header('Location: login.php');
            exit;
        } else {
            $message = "注册失败，请重试。";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>古代物理学注册</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background: url('../source/back.jpg') no-repeat center center fixed; /* 使用一个古代风格的背景图片 */
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .register-container {
            width: 400px;
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
        input[type="text"], input[type="password"], input[type="email"] {
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
    <div class="register-container">
        <form action="register.php" method="post">
            <h2>注册新用户</h2>
            <label for="username">用户名:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密码:</label>
            <input type="password" id="password" name="password" required>
            <label for="email">电子邮件:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">注册</button>
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>