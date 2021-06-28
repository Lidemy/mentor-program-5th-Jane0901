<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_admin.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
  }

  $sql = 
    'SELECT
      A.id AS id, A.title AS title, A.content AS content, A.created_at AS created_at, A.username AS author,
      C.classname AS classname
    FROM jane_blog_articles AS A
    LEFT JOIN jane_blog_categories AS C
    ON A.category = C.id
    WHERE A.is_deleted = 0 AND A.username = ?
    ORDER BY A.id DESC
    ';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('s', $username);
  $result = $stmt -> execute();
  if (!$result) {
    die('Error:' . $conn -> error);
  }
  $result = $stmt -> get_result();
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
    <?php 
      while ($row = $result -> fetch_assoc()) {
    ?>
    <main>
      <?php
        $result->data_seek(0);
        while ($row = $result -> fetch_assoc()) { 
      ?>
      <div class="page">
        <a  class="page__title" href="article.php?blog=<?php echo escape($username)?>&id=<?php echo escape($row['id'])?>"><?php echo escape($row['title'])?></a>
        <div class="page__wrapper">
          <p class="page__time"><?php echo escape($row['created_at'])?></p>
          <div class="page_btns">
          <?php if ($username) { ?>
            <a class="page__edit-btn" href="update_article.php?id=<?php echo escape($row['id'])?>">編輯</a>
            <a class="page__edit-btn" href="handle_delete_article.php?id=<?php echo escape($row['id'])?>">刪除</a>
          <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </main>
    <?php } ?>
  </div>
  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
</body>
</html>
