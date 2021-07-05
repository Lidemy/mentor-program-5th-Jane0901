<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
  }

  $blog = 'jane';
  if (!empty($_GET['blog'])) {
    $blog = $_GET['blog'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Who's Blog</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normalize.css">
</head>
<body>
  <?php include_once('navbar.php');?>
  <div class="wrapper">
    <form class="form__login" method="post" action="handle_login.php?blog=<?php echo escape($blog)?>" >
      <h1 class="form__login-title">Log In</h1>
      <div class="form__login-item">
        USERNAME<br>
        <input type="text" name="username">
      </div>
      <div class="form__login-item">
        PASSWORD<br>
        <input type="password" name="password">
      </div>
      <input class="form__login-btn" type="submit" value="SIGN IN">
      <?php
        if ($_GET['errCode']) {
          $errCode = $_GET['errCode'];
          $msg = "錯誤";
          if ($errCode === "1") {
            $msg = "帳號或密碼空白";
          } else if ($errCode === "2") {
            $msg = "帳號或密碼輸入錯誤";
          }
          echo '<p class="form__input-warning">' . $msg . '</p>';
        }
      ?>
    </form>
  </div>
  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
</body>
</html>
