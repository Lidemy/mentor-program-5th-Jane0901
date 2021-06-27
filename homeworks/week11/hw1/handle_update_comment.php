<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header('Location: update_comment.php?errCode=1');
    die();
  }

  $user = getUserFromUsername($_SESSION['username']);
  $username = $user['username'];
  $role = $user['role'];
  $content = $_POST['content'];
  $id = $_POST['id'];

  if ($role == 2 || $username === $_POST['username']) {
    $sql = 'UPDATE jane_board_comments SET content = ? WHERE id = ?';
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('si', $content, $id);
    $result = $stmt -> execute();
    if(!$result) {
      die($conn -> error);
    }
  }

  header('Location: index.php')
?>
