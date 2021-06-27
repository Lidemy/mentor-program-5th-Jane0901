<?php
  require_once('conn.php');

  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf("SELECT * FROM jane_board_users WHERE username = ?");
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('s', $username);
    $result = $stmt -> execute();
    $result = $stmt -> get_result();
    if (!$result) {
      die('Error:' . $conn->error);
    }
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
?>
