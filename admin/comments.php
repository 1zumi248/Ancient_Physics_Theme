<?php
session_start();
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit;
}

require_once '../php/con_mysql.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>评论管理 - 中国古代物理科学</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        .comments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .comments-table th,
        .comments-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .comments-table th {
            background-color: var(--primary-color);
            color: white;
        }

        .comments-table tr:hover {
            background-color: #f5f5f5;
        }

        .delete-btn {
            color: #dc3545;
            cursor: pointer;
            border: none;
            background: none;
            padding: 5px;
            transition: color 0.3s;
        }

        .delete-btn:hover {
            color: #bd2130;
        }

        .search-bar {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }

        .search-bar input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 8px 16px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background: var(--secondary-color);
        }

        .no-comments {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <?php include '../templates/nav.php'; ?>
    <main class="main-content">
        <section class="section">
            <h2>评论管理</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="搜索评论内容或用户名...">
                <button onclick="searchComments()">搜索</button>
            </div>
            <div class="table-container">
                <table class="comments-table">
                    <thead>
                        <tr>
                            <th>用户名</th>
                            <th>评论内容</th>
                            <th>页面</th>
                            <th>位置</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="commentsTableBody">
                        <?php
                        try {
                            $stmt = $pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
                            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (empty($comments)) {
                                echo '<tr><td colspan="6" class="no-comments">暂无评论</td></tr>';
                            } else {
                                foreach ($comments as $comment) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($comment['username']) . '</td>';
                                    echo '<td>' . htmlspecialchars($comment['content']) . '</td>';
                                    echo '<td>' . htmlspecialchars($comment['page_id']) . '</td>';
                                    echo '<td>' . htmlspecialchars($comment['element_id']) . '</td>';
                                    echo '<td>' . $comment['created_at'] . '</td>';
                                    echo '<td><button class="delete-btn" onclick="deleteComment(' . $comment['id'] . 
                                         ')"><i class="fas fa-trash-alt"></i></button></td>';
                                    echo '</tr>';
                                }
                            }
                        } catch (PDOException $e) {
                            echo '<tr><td colspan="6">获取评论失败: ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        function deleteComment(commentId) {
            if (!confirm('确定要删除这条评论吗？')) {
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../php/comment_actions.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // 删除成功后移除对应的表格行
                            const row = document.querySelector(`button[onclick="deleteComment(${commentId})"]`).closest('tr');
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 300);
                        } else {
                            alert(response.message || '删除失败');
                        }
                    } catch (e) {
                        console.error('解析响应失败:', xhr.responseText);
                        alert('删除失败，请稍后重试');
                    }
                }
            };

            xhr.send('action=delete&commentId=' + encodeURIComponent(commentId));
        }

        function searchComments() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#commentsTableBody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        }

        // 为搜索输入框添加实时搜索功能
        document.getElementById('searchInput').addEventListener('input', searchComments);
    </script>
</body>
</html> 