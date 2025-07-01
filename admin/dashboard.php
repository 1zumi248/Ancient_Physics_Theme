<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    error_log('Unauthorized access attempt to admin dashboard');
    header('Location: ../index.php');
    exit;
}

// 检查数据库连接
require_once '../php/con_mysql.php';
if (!$pdo) {
    error_log('Database connection failed in admin dashboard');
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员面板 - 中国古代物理科学</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php include '../templates/nav.php'; ?>

    <main class="main-content">
        <section class="section">
            <h2>用户管理</h2>
            <div class="admin-controls">
                <div class="control-panel">
                    <h3>重置用户密码</h3>
                    <form id="resetPasswordForm">
                        <input type="text" name="username" placeholder="用户名" required>
                        <button type="submit">重置为6666</button>
                    </form>
                </div>

                <div class="control-panel">
                    <h3>添加用户</h3>
                    <form id="addUserForm">
                        <input type="text" name="username" placeholder="用户名" required>
                        <input type="email" name="email" placeholder="邮箱" required>
                        <input type="password" name="password" placeholder="密码" required>
                        <button type="submit">添加用户</button>
                    </form>
                </div>

                <div class="control-panel">
                    <h3>封禁用户</h3>
                    <form id="banUserForm">
                        <input type="text" name="username" placeholder="用户名" required>
                        <input type="number" name="days" placeholder="封禁天数" required>
                        <button type="submit">封禁用户</button>
                    </form>
                </div>

                <div class="control-panel">
                    <h3>注销用户</h3>
                    <form id="deleteUserForm">
                        <input type="text" name="username" placeholder="用户名" required>
                        <button type="submit">注销用户</button>
                    </form>
                </div>

                <div class="control-panel">
                    <h3>解除封禁</h3>
                    <form id="unbanUserForm">
                        <input type="text" name="username" placeholder="用户名" required>
                        <button type="submit">解除封禁</button>
                    </form>
                </div>

                <div class="control-panel">
                    <h3>修改用户密码</h3>
                    <form id="changePasswordForm">
                        <input type="text" name="username" placeholder="用户名" required>
                        <input type="password" name="newPassword" placeholder="新密码" required>
                        <button type="submit">修改密码</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <div id="messageArea" class="message-area" style="display: none;"></div>

    <style>
    .message-area {
        margin: 20px auto;
        padding: 15px;
        border-radius: 4px;
        max-width: 800px;
        text-align: center;
    }

    .message-area.success {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
    }

    .message-area.error {
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
    }
    </style>

    <script src="../js/admin.js"></script>
</body>
</html> 