<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if($_SESSION['username']) {
    $username = $_SESSION['username'];
  }

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
      <?php if(!$username) { ?>   
        <a class="board_btn" href="register.php">註冊</a>
        <a class="board_btn" href="login.php">登入</a>
      <?php }else{ ?>
        <a class="board_btn" href="logout.php">登出</a>
      <?php }?>
    </div>
    <h1 class="board__title">Comments</h1>
    <?php
      if($_GET['errCode']) {
        $code = $_GET['errCode'];
        $msg = 'error';
        if($code === '1') {
          $msg = '要輸入內容才能送出唷';
        }
        echo '<p class="error">' . $msg . '</p>';
      }
    ?>
    <?php if(!$username) { ?>
      <h3 class="board__greet">限登入者發布留言</h3>
    <?php } else{ ?>
    <h3 class="board__greet">
      <?php
      if($_SESSION['username']) {
        $user = getUserFromUsername($_SESSION['username']);
        $nickname = $user['nickname'];
        echo $nickname . "，有什麼想說的嗎？";
      }
      ?>
    </h3>
    <form class="board__add-content" method="post" action="handle_add_comment.php">
      <textarea name="content" id="" cols="35" rows="5" placeholder="請輸入你的留言..."></textarea>
      <input class="board__submit-btn" type="submit" value="送出">
    </form>
    <?php } ?>
    <hr>
    <section class="board__comments">
      <?php
        while($row = $result->fetch_assoc()) {
      ?>
      <div class="comment">
        <div class="comment__avatar"></div>
        <div class="comment__content">
          <div class="comment__info">
            <span class="comment__author"><?php echo $row['nickname'];?></span>
            <span class="comment__time"><?php echo $row['created_at']?></span>
          </div>
          <p class="comment__text"><?php echo $row['content']?></p>
        </div>
      </div>
      <?php
        }?>
    </section>
  </main>
  
</body>
</html>
