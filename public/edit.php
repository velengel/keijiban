<?php
// includes/db.phpファイルを読み込む
require_once '../includes/db.php';

// URLパラメータから投稿IDを取得する
$id = $_GET['id'];

// データベースから該当の投稿を取得する
$stmt = $conn->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// フォームが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 投稿をデータベースで更新する
    $stmt = $conn->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // 投稿詳細ページにリダイレクトする
    header('Location: post.php?id=' . $id);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>投稿の編集</title>
</head>
<body>
    <h1>投稿の編集</h1>

    <!-- 投稿のフォーム (既存の投稿データでプリフィルされる) -->
    <form method="post">
        <label for="title">タイトル:</label><br>
        <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br><br>

        <label for="content">内容:</label><br>
        <textarea name="content" required><?php echo $post['content']; ?></textarea><br><br>

        <input type="submit" value="更新する">
    </form>
</body>
</html>
