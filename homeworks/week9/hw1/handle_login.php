<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if(!$_POST['username'] | !$_POST['password']) {
    header("Location: login.php?errCode=1");
    die();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "SELECT * FROM jane_board_users WHERE username='%s' AND password='%s'",
    $username,
    $password
  );
  $result = $conn->query($sql);
  if(!$result) {
    die($conn->error);
  }

  if($result->num_rows) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
?>
