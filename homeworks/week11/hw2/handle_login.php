<?php
  require_once('conn.php');
  session_start();

  if (empty($_POST['username']) || empty($_POST['password'])) {
    header('Location: login.php?errCode=1');
    die();
  }

  $blog = 'jane';
  if (!empty($_GET['blog'])) {
    $blog = $_GET['blog'];
  }

  $username = $_POST['username'];
  $password = $_POST['password'];
  

  $sql = 'SELECT username, password FROM jane_blog_users WHERE username = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('s', $username);
  $result = $stmt -> execute();
  if (!$result) {
    die ($conn -> error);
  }

  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header('Location: index.php?blog=' . $blog);
  } else {
    header('Location: login.php?errCode=2');
  }
?>
