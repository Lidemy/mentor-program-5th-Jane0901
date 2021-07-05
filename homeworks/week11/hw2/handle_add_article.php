<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_admin.php');

  if (
    empty($_POST['title']) ||
    empty($_POST['category']) ||
    empty($_POST['content'])
  ) {
    header('Location: add_article.php?errCode=1');
    die();
  }

  $title = $_POST['title'];
  $category = $_POST['category'];
  $content = $_POST['content'];
  $username = $_SESSION['username'];

  $sql = 'INSERT INTO jane_blog_articles(title, category, content, username) VALUES(?, ?, ?, ?)';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('ssss', $title, $category, $content, $username);
  $result = $stmt -> execute();
  if (!$result) {
    die ($conn -> error);
  }

  header('Location: index.php?blog=' . $username);
?>
