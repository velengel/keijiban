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

// データベースから投稿に対する返信を取得する
$stmt = $conn->prepare('SELECT * FROM replies WHERE post_id = :post_id');
$stmt->bindParam(':post_id', $id);
$stmt->execute();
$replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>投稿詳細</title>
  <link rel="stylesheet" href="styles.css"> <!-- 追加：外部CSSファイルのリンク -->
</head>
<body>
  <div class="container">
    <h1><?php echo $post['title']; ?></h1>
    <p><?php echo $post['content']; ?></p>

    <!-- 返信フォーム -->
    <h2>返信</h2>
    <form method="post" action="reply.php">
      <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
      <div class="form-group">
        <label for="reply_content">返信内容:</label>
        <textarea name="reply_content" required></textarea>
      </div>
      <div class="form-group">
        <input type="submit" value="返信する">
      </div>
    </form>

    <!-- 返信の表示 -->
    <?php foreach ($replies as $reply): ?>
      <div class="reply">
        <p><?php echo $reply['content']; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
