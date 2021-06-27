<?php
  session_start();
  require_once('conn.php');

  if (!$_POST['nickname'] || !$_POST['username'] || !$_POST['password']) {
    header('Location: register.php?errCode=1');
    die();
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = 'INSERT INTO jane_board_users(nickname, username, password) VALUES (?, ?, ?)';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('sss', $nickname, $username, $password);
  $result = $stmt -> execute();
  if (!$result) {
    $code = $conn -> errno;
    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    }
    die ($conn -> error);
  }

  $_SESSION['username'] = $username;
  header('Location: index.php');
?>
