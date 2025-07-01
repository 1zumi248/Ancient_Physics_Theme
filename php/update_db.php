<?php
require_once 'con_mysql.php';

try {
    $sql = "ALTER TABLE users ADD COLUMN IF NOT EXISTS banned_until DATETIME DEFAULT NULL";
    $pdo->exec($sql);
    echo "成功添加 banned_until 字段";
} catch (PDOException $e) {
    echo "错误：" . $e->getMessage();
}
?> 