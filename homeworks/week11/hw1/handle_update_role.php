<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($_SESSION['username']);
    $real_role = $user['role'];
  }
  
  if ($user === NULL || $real_role !== 2) {
    header('Location: index.php');
    exit;
  }

  $id = $_POST['id'];
  $role = $_POST['role'];

  $sql = 'UPDATE jane_board_users SET role = ? WHERE id = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('ii', $role, $id);
  $result = $stmt -> execute();
  if (!$result) {
    $code = $conn -> errno;
    die ($conn -> error);
  }

  header('Location: admin.php');
?>
