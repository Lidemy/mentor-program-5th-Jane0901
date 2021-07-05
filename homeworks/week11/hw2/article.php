<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
  }

  $blog = 'jane';
  if (!empty($_GET['blog'])) {
    $blog = $_GET['blog'];
  }

  if (empty($_GET['id'])) {
    header('Location: index.php');
  }
  $id = $_GET['id'];

  $sql = 
    'SELECT
      A.id AS id, A.title AS title, A.content AS content, A.created_at AS created_at, A.username AS author,
      C.classname AS classname
    FROM jane_blog_articles AS A
    LEFT JOIN jane_blog_categories AS C
    ON A.category = C.id
    WHERE A.id = ? AND A.is_deleted = 0
    ';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('s', $id);
  $result = $stmt -> execute();
  if (!$result) {
    die('Error:' . $conn -> error);
  }
  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
  if (empty($row)) {
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Who's Blog</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normalize.css">
</head>
<body>
  <?php include_once('navbar.php');?>
  <div class="wrapper">
    <div class="banner">
      <h1 class="banner__title">存放技術之地</h1>
      <p>Welcome to my blog</p>
    </div>
    <main>
      <div class="article">
        <div class="article__top">
          <p class="article__title"><?php echo escape($row['title'])?></p>
          <div class="article__btns">
            <?php if ($username === $row['author']) { ?>
              <a class="article__edit-btn" href="update_article.php?id=<?php echo escape($row['id'])?>">編輯</a>
              <a class="article__edit-btn" href="handle_delete_article.php?id=<?php echo escape($row['id'])?>">刪除</a>
            <?php } ?>
          </div>
        </div>
        <div class="article__info">
          <div class="article__info-time">
            <img src="img/watch-later-24-px@3x.png" alt="時間">
            <p><?php echo escape($row['created_at'])?></p>
          </div>
          <div class="article__info-category">
            <img src="img/folder-24-px@3x.png" alt="類別">
            <p><?php echo escape($row['classname'])?></p>
          </div>
        </div>
        <div class="article__content-complete"><?php echo $row['content']?></div>
      </div>
    </main>
  </div>
  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
</body>
</html>
