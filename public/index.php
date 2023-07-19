<?php
// includes/db.phpファイルを読み込む
require_once '../includes/db.php';

// データベースから投稿を取得する
$stmt = $conn->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>掲示板</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>掲示板</h1>

    <!-- 投稿一覧の表示 -->
    <div class="container">
  <div class="row">
    <?php foreach ($posts as $post): ?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $post['title']; ?></h5>
            <p class="card-text"><?php echo $post['created_at']; ?></p>
            <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">詳細</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


    <!-- 新しい投稿の作成リンク -->
    <div class="create-link">
  <a href="create.php" class="btn btn-primary">新しい投稿を作成する</a>
</div>

</body>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
  }

  h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
  }

  .post-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .post-list li {
    margin-bottom: 20px;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .post-list li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 18px;
  }

  .post-list li a:hover {
    text-decoration: underline;
  }

  .create-link {
    display: block;
    text-align: center;
    margin-bottom: 20px;
  }

  .create-link a {
    text-decoration: none;
    color: #fff;
    background-color: #333;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
  }

  .create-link a:hover {
    background-color: #444;
  }

  .post-details {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .post-details h2 {
    color: #333;
    margin-bottom: 10px;
  }

  .post-details p {
    color: #666;
    margin-bottom: 20px;
  }

  .post-details .btn-container {
    text-align: right;
  }

  .post-details .btn-container a {
    text-decoration: none;
    color: #fff;
    background-color: #333;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
  }

  .post-details .btn-container a:hover {
    background-color: #444;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  .form-group input[type="text"],
  .form-group textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  .form-group input[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
  }

  .form-group input[type="submit"]:hover {
    background-color: #444;
  }
  .create-link {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

</style>


</html>
