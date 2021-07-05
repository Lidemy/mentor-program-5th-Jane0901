<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_admin.php');

  $pre_url = $_SERVER['HTTP_REFERER'];

  if (empty($_GET['id'])) {
    header('Location:' . $pre_url);
    die();
  }

  $id = $_GET['id'];
  $username = $_SESSION['username'];

  $sql = 'UPDATE jane_blog_articles SET is_deleted = 1 WHERE id =? AND username = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('is', $id, $username);
  $result = $stmt -> execute();
  if (!$result) {
    die ($conn -> error);
  }

  header('Location:' . $pre_url);
?>
