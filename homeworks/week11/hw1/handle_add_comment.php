<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header('Location: index.php?errCode=1');
    die();
  }

  $user = getUserFromUsername($_SESSION['username']);
  $username = $user['username'];
  $nickname = $user['nickname'];
  $role = $user['role'];
  $content = $_POST['content'];

  if ($role == 0) {
    header('Location: index.php');
    die();
  }

  $sql = 'INSERT INTO jane_board_comments(username, nickname, content) VALUES (?, ?, ?)';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('sss', $username, $nickname, $content);
  $result = $stmt -> execute();
  if(!$result) {
    die($conn -> error);
  }

  header('Location: index.php')
?>
