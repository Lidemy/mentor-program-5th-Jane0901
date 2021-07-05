<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $id = $_GET['id'];

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($_SESSION['username']);
    $nickname = $user['nickname'];
  }

  $stmt = $conn -> prepare("SELECT * FROM jane_board_comments WHERE id = ?");
  $stmt -> bind_param("i", $id);
  $result = $stmt -> execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
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
    <div class="board__btns">
        <a class="board__btn" href="index.php">回留言板</a>
        <a class="board__btn" href="logout.php">登出</a>
    </div>
    <h1 class="board__title">Comments</h1>
    <?php
      if ($_GET['errCode']) {
        $code = $_GET['errCode'];
        $msg = 'error';
        if ($code === '1') {
          $msg = '要輸入內容才能送出唷';
        }
        echo '<p class="error">' . $msg . '</p>';
      }
    ?>
    <h3 class="board__greet">編輯留言</h3>
    <form class="board__add-content" method="post" action="handle_update_comment.php">
      <textarea name="content" cols="35" rows="5"><?php echo escape($row['content']);?></textarea>
      <input type="hidden" name="id" value="<?php echo escape($row['id'])?>">
      <input type="hidden" name="username" value="<?php echo escape($row['username'])?>">
      <input class="board__submit-btn" type="submit" value="確定">
      <input class="board__cancel-btn" type="submit" value="取消">
    </form>
  </main>
  <script>
    document.
      querySelector(".board__cancel-btn").
      addEventListener('click', e => {
        e.preventDefault()
        window.location.href="index.php"
      })
  </script>
</body>
</html>
