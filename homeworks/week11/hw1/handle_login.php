<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (!$_POST['username'] | !$_POST['password']) {
    header('Location: login.php?errCode=1');
    die();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = 'SELECT * FROM jane_board_users WHERE username = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('s', $username);
  $result = $stmt -> execute();
  if (!$result) {
    die($conn -> error);
  }

  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header('Location: index.php');
  } else {
    header('Location: login.php?errCode=2');
  }
?>
