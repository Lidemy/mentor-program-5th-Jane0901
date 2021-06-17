<?php
  require_once('conn.php');

  if(!$_POST['nickname'] || !$_POST['username'] || !$_POST['password']) {
    header("Location: register.php?errCode=1");
    die();
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "INSERT INTO jane_board_users(nickname, username, password) VALUES ('%s', '%s', '%s')",
    $nickname,
    $username,
    $password
  );
  $result = $conn->query($sql);
  if(!$result) {
    $code = $conn->errno;
    if($code === 1062){
      header("Location: register.php?errCode=2");
    }
    die($conn->error);
  }

  header("Location: index.php")
?>
