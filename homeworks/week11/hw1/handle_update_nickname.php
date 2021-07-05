<?php
  session_start();
  require_once('conn.php');

  if (!$_POST['nickname']) {
    header('Location: information.php?errCode=1');
    die();
  }

  $nickname = $_POST['nickname'];
  $username = $_SESSION['username'];

  $sql = 'UPDATE jane_board_users SET nickname = ? WHERE username = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('ss', $nickname, $username);
  $result = $stmt -> execute();
  if (!$result) {
    $code = $conn -> errno;
    die ($conn -> error);
  }

  header('Location: index.php');
?>
