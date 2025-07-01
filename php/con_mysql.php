<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ancient_physics';

try {
    // 先连接到 MySQL，不指定数据库
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 检查数据库是否存在，不存在则创建
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
    if (!$stmt->fetch()) {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }
    
    // 切换到指定数据库
    $pdo->exec("USE $dbname");
    
    // 检查并创建用户表
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        banned_until DATETIME DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    
    $pdo->exec($sql);

    // 检查并创建评论表
    $sql = "CREATE TABLE IF NOT EXISTS comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        username VARCHAR(50) NOT NULL,
        content TEXT NOT NULL,
        page_id VARCHAR(255) NOT NULL,
        element_id VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    
    $pdo->exec($sql);

    // 检查 banned_until 字段是否存在
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'banned_until'");
    if ($stmt->rowCount() == 0) {
        // 如果字段不存在，添加它
        $pdo->exec("ALTER TABLE users ADD COLUMN banned_until DATETIME DEFAULT NULL");
    }

    return $pdo;
    
} catch (PDOException $e) {
    throw new Exception("数据库连接失败: " . $e->getMessage());
}
?>