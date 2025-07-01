<?php
// 确保没有之前的输出
ob_clean();

// 设置错误处理
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// 设置响应头
header('Content-Type: application/json; charset=utf-8');

// 错误处理函数
function sendJsonError($message, $code = 400) {
    http_response_code($code);
    echo json_encode(['success' => false, 'message' => $message]);
    exit;
}

// 启动会话
session_start();

// 验证管理员权限
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    sendJsonError('无权限', 403);
}

// 验证请求方法
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonError('无效的请求方法', 405);
}

try {
    // 包含数据库配置
    $pdo = require_once __DIR__ . '/con_mysql.php';
    
    // 获取动作类型
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if (empty($action)) {
        sendJsonError('未指定操作类型');
    }

    switch ($action) {
        case 'reset_password':
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            if (empty($username)) {
                sendJsonError('用户名不能为空');
            }
            
            $stmt = $pdo->prepare("UPDATE users SET password = '6666' WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() === 0) {
                sendJsonError('用户不存在');
            }
            
            echo json_encode([
                'success' => true,
                'message' => '密码已重置为6666'
            ]);
            break;

        case 'add_user':
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            
            if (empty($username) || empty($email) || empty($password)) {
                sendJsonError('所有字段都必须填写');
            }
            
            // 先检查用户名是否已存在
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $checkStmt->execute([$username]);
            if ($checkStmt->fetchColumn() > 0) {
                sendJsonError('用户名已存在');
            }
            
            // 检查邮箱是否已存在
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $checkStmt->execute([$email]);
            if ($checkStmt->fetchColumn() > 0) {
                sendJsonError('邮箱已被使用');
            }
            
            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $password]);
                
                echo json_encode([
                    'success' => true,
                    'message' => '用户添加成功'
                ]);
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) { // 唯一性约束违反
                    sendJsonError('用户名或邮箱已存在');
                } else {
                    throw $e; // 重新抛出其他类型的错误
                }
            }
            break;

        case 'unban_user':
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            if (empty($username)) {
                sendJsonError('用户名不能为空');
            }
            
            // 检查用户是否存在
            $checkStmt = $pdo->prepare("SELECT banned_until FROM users WHERE username = ?");
            $checkStmt->execute([$username]);
            $user = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                sendJsonError('用户不存在');
            }
            
            if ($user['banned_until'] === null) {
                sendJsonError('该用户未被封禁');
            }
            
            // 解除封禁
            $stmt = $pdo->prepare("UPDATE users SET banned_until = NULL WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() === 0) {
                sendJsonError('解除封禁失败');
            }
            
            echo json_encode([
                'success' => true,
                'message' => '用户已成功解除封禁'
            ]);
            break;

        case 'ban_user':
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $days = isset($_POST['days']) ? (int)$_POST['days'] : 0;
            
            if (empty($username) || $days <= 0) {
                sendJsonError('参数错误');
            }
            
            // 检查用户是否存在
            $checkStmt = $pdo->prepare("SELECT banned_until FROM users WHERE username = ?");
            $checkStmt->execute([$username]);
            $user = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                sendJsonError('用户不存在');
            }
            
            $banned_until = date('Y-m-d H:i:s', strtotime("+$days days"));
            $stmt = $pdo->prepare("UPDATE users SET banned_until = ? WHERE username = ?");
            $stmt->execute([$banned_until, $username]);
            
            if ($stmt->rowCount() === 0) {
                sendJsonError('封禁失败');
            }
            
            echo json_encode([
                'success' => true,
                'message' => "用户已被封禁至 $banned_until"
            ]);
            break;

        case 'delete_user':
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            if (empty($username)) {
                sendJsonError('用户名不能为空');
            }
            
            $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() === 0) {
                sendJsonError('用户不存在');
            }
            
            echo json_encode([
                'success' => true,
                'message' => '用户已删除'
            ]);
            break;

        case 'change_password':
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : '';
            
            if (empty($username) || empty($newPassword)) {
                sendJsonError('用户名和新密码都不能为空');
            }
            
            // 检查用户是否存在
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $checkStmt->execute([$username]);
            if ($checkStmt->fetchColumn() == 0) {
                sendJsonError('用户不存在');
            }
            
            // 更新密码
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->execute([$newPassword, $username]);
            
            if ($stmt->rowCount() === 0) {
                sendJsonError('密码修改失败');
            }
            
            echo json_encode([
                'success' => true,
                'message' => '密码修改成功'
            ]);
            break;

        default:
            sendJsonError('未知操作');
    }
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    sendJsonError('数据库错误：' . $e->getMessage(), 500);
} catch (Exception $e) {
    error_log('Server error: ' . $e->getMessage());
    sendJsonError('服务器错误：' . $e->getMessage(), 500);
}
?> 