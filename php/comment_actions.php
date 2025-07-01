<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

// 添加错误日志
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

require_once 'con_mysql.php';

function sendJsonResponse($success, $message, $data = null) {
    echo json_encode(array(
        'success' => $success,
        'message' => $message,
        'data' => $data
    ));
    exit;
}

// 获取动作类型
$action = '';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// 调试信息
error_log("Received action: " . $action);
error_log("Session data: " . print_r($_SESSION, true));
error_log("POST data: " . print_r($_POST, true));

// 修改登录检查逻辑
switch ($action) {
    case 'delete':
        // 删除操作只需要检查管理员权限
        if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
            sendJsonResponse(false, '无权限删除评论');
        }
        break;
    case 'add':
        // 添加评论需要检查普通用户登录
        if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
            sendJsonResponse(false, '请先登录');
        }
        break;
    case 'get':
        // 获取评论不需要任何权限检查
        break;
    default:
        sendJsonResponse(false, '未知操作');
}

try {
    switch ($action) {
        case 'add':
            // 获取并验证参数
            if (!isset($_POST['content']) || !isset($_POST['pageId']) || !isset($_POST['elementId'])) {
                sendJsonResponse(false, '参数不完整: ' . implode(', ', array_keys($_POST)));
            }
            
            $content = trim($_POST['content']);
            $pageId = trim($_POST['pageId']);
            $elementId = trim($_POST['elementId']);
            
            if (empty($content)) {
                sendJsonResponse(false, '评论内容不能为空');
            }
            
            // 记录插入前的信息
            error_log("Attempting to insert comment with data: " . print_r([
                'user_id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'content' => $content,
                'pageId' => $pageId,
                'elementId' => $elementId
            ], true));
            
            // 插入评论
            $stmt = $pdo->prepare("INSERT INTO comments (user_id, username, content, page_id, element_id) VALUES (?, ?, ?, ?, ?)");
            $result = $stmt->execute(array(
                $_SESSION['user_id'],
                $_SESSION['username'],
                $content,
                $pageId,
                $elementId
            ));
            
            if ($result) {
                $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false;
                sendJsonResponse(true, '评论成功', array(
                    'id' => $pdo->lastInsertId(),
                    'username' => $_SESSION['username'],
                    'content' => $content,
                    'isAdmin' => $isAdmin
                ));
            } else {
                error_log("Insert failed. PDO error info: " . print_r($stmt->errorInfo(), true));
                sendJsonResponse(false, '评论失败: ' . $stmt->errorInfo()[2]);
            }
            break;
            
        case 'get':
            if (!isset($_GET['pageId']) || !isset($_GET['elementId'])) {
                sendJsonResponse(false, '参数不完整');
            }
            
            $pageId = $_GET['pageId'];
            $elementId = $_GET['elementId'];
            
            $stmt = $pdo->prepare("SELECT * FROM comments WHERE page_id = ? AND element_id = ? ORDER BY created_at DESC");
            $stmt->execute(array($pageId, $elementId));
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            sendJsonResponse(true, '获取成功', $comments);
            break;
            
        case 'delete':
            if (!isset($_POST['commentId'])) {
                sendJsonResponse(false, '参数不完整');
            }
            
            $commentId = (int)$_POST['commentId'];
            $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
            $result = $stmt->execute(array($commentId));
            
            if ($result) {
                sendJsonResponse(true, '删除成功');
            } else {
                sendJsonResponse(false, '删除失败');
            }
            break;
            
        default:
            sendJsonResponse(false, '未知操作');
    }
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    sendJsonResponse(false, '数据库错误：' . $e->getMessage());
} catch (Exception $e) {
    error_log('General error: ' . $e->getMessage());
    sendJsonResponse(false, '服务器错误：' . $e->getMessage());
}
?> 