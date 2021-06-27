<?php
  require_once('conn.php');
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
    <form class="form__register" method="post" action="handle_register.php" >
      <h1 class="form__register-title">Register</h1>
      <div class="form__register-item">
        USERNAME<br>
        <input type="text" name="username">
      </div>
      <div class="form__register-item">
        PASSWORD<br>
        <input type="password" name="password">
      </div>
      <input class="form__register-btn" type="submit" value="SIGN Up">
      <?php
        if ($_GET['errCode']) {
          $errCode = $_GET['errCode'];
          $msg = "錯誤";
          if ($errCode === "1") {
            $msg = "資料不齊全";
          } else if ($errCode === "2") {
            $msg = "帳號已被註冊";
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
