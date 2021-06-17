<?php
  require_once('conn.php');

  function generatedToken() {
    $s = '';
    for($i=1;$i<=16;$i++) {
      $s .= chr(rand(65,90));
    }
    return $s;
  }

  function getUserFromUsername($username) {
    global $conn;
      $sql = sprintf(
      "SELECT * FROM jane_board_users WHERE username = '%s'",
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }
?>
