<?php
// includes/db.phpファイルを読み込む
require_once '../includes/db.php';

// フォームが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 投稿をデータベースに挿入する
    $stmt = $conn->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->execute();

    // メインページにリダイレクトする
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>新しい投稿</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <h1>新しい投稿</h1>

    <!-- 新しい投稿のフォーム -->
    <form method="post">
        <label for="title">タイトル:</label><br>
        <input type="text" name="title" required><br><br>

        <label for="content">内容:</label><br>
        <textarea name="content" required></textarea><br><br>

        <input type="submit" value="投稿する">
    </form>
</body>
</html>
