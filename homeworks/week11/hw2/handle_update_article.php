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
  $id = $_POST['id'];
  $username = $_SESSION['username'];

  $sql = 'UPDATE jane_blog_articles SET title = ?, category = ?, content = ? WHERE id = ? AND username = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('sssis', $title, $category, $content, $id, $username);
  $result = $stmt -> execute();
  if (!$result) {
    die ($conn -> error);
  }

  header('Location: index.php?blog=' . $username);
?>
