<?php
  require_once('conn.php');

  $result = $conn->query("SELECT * FROM jane_board_comments ORDER by id DESC");
  if(!$result) {
    die('Error:' . $conn->error);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normalize.css">
</head>
<body>
  <header class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </header>
  <main class="board">
    <div class="board_btns">
      <a class="board_btn" href="index.php">回留言板</a>
      <a class="board_btn" href="login.php">登入</a>
    </div>
    <h1 class="board__title">註冊</h1>
    <?php
      if(!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'error';
        if($code === '1') {
          $msg = '資料不齊全';
        } else if($code === '2') {
          $msg = '帳號已被註冊';
        }
        echo '<p class="error">' . $msg . '</p>';
      }
    ?>
    <form class="board__register" method="post" action="handle_register.php">
      <div class="board__register-item">
        暱稱：<input type="text" name="nickname">
      </div>
      <div class="board__register-item">
        帳號：<input type="text" name="username">
      </div>
      <div class="board__register-item">
        密碼：<input type="password" name="password">
      </div>
      <input class="board__submit-btn" type="submit" value="註冊">
    </form>
  </main>
  
</body>
</html>
