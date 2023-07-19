<?php
// includes/db.phpファイルを読み込む
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post_id = $_POST['post_id'];
  $content = $_POST['reply_content'];

  // 返信をデータベースに挿入する
  $stmt = $conn->prepare('INSERT INTO replies (post_id, content) VALUES (:post_id, :content)');
  $stmt->bindParam(':post_id', $post_id);
  $stmt->bindParam(':content', $content);
  $stmt->execute();

  // リダイレクトまたは返信後の処理を行う
  header('Location: index.php');
  exit;
}
?>
