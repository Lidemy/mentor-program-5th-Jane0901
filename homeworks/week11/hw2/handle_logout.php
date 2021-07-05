<?php
  $blog = 'jane';
  if (!empty($_GET['blog'])) {
    $blog = $_GET['blog'];
  }
  session_start();
  session_destroy();
  header('Location: index.php?blog=' . $blog);
?>
