<?php
session_start();

// 清除所有会话变量
$_SESSION = array();

// 销毁会话
session_destroy();

// 返回 JSON 响应
header('Content-Type: application/json');
echo json_encode(['success' => true]);
?> 