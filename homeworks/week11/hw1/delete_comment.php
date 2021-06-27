<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_GET['id'])) {
    header('Location: index.php');
    die();
  }

  $id = $_GET['id'];
  $username = $_SESSION['username'];
  $user = getUserFromUsername($_SESSION['username']);
  $role = $user['role'];

  if ($role == 2) {
    $sql = 'UPDATE jane_board_comments SET is_deleted = 1 WHERE id = ?';
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('i', $id);
  } else {
    $sql = 'UPDATE jane_board_comments SET is_deleted = 1 WHERE id = ? AND username = ?';
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('is', $id, $username);
  }
  $result = $stmt -> execute();
  if(!$result) {
    die($conn -> error);
  }

  header('Location: index.php');
?>
