<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($_SESSION['username']);
    $nickname = $user['nickname'];
    $role = $user['role'];
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $items_per_page = 10;
  $offset = ($page - 1) * $items_per_page;

  $sql = 
    'SELECT 
      C.id AS id, C.content AS content, C.created_at AS created_at,
      U.username AS username, U.nickname AS nickname, U.role AS role
    FROM jane_board_comments AS C
    LEFT JOIN jane_board_users AS U
    ON U.username = C.username
    WHERE C.is_deleted = 0
    ORDER BY C.id DESC
    LIMIT ? OFFSET ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('ii', $items_per_page, $offset);
  $result = $stmt -> execute();
  if (!$result) {
    die('Error:' . $conn -> error);
  }
  $result = $stmt -> get_result();
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
      <?php if ($role == 2) { ?>
        <a class="board__btn board__admin-btn" href="admin.php">管理使用者</a>
      <?php } ?>
      <?php if (!$username) { ?>   
        <a class="board__btn" href="register.php">註冊</a>
        <a class="board__btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="board__btn" href="information.php">個人資料</a>
        <a class="board__btn" href="logout.php">登出</a>
      <?php } ?>
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
    <?php if (!$username) { ?>
      <h3 class="board__greet">限登入者發布留言</h3>
    <?php } else if ($role == 0) { ?>
      <h3 class="board__greet">您已被停權</h3>
    <?php } else { ?>
    <h3 class="board__greet">
      <?php
        if ($_SESSION['username']) {
          echo escape($nickname) . '，有什麼想說的嗎？';
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
      <?php while ($row = $result -> fetch_assoc()) { ?>
      <div class="comment">
        <div class="comment__avatar"></div>
        <div class="comment__content">
          <div class="comment__info">
            <span class="comment__author">
              <?php echo escape($row['nickname']); ?>
              (@<?php echo escape($row['username']); ?>)
            </span>
            <span class="comment__time"><?php echo escape($row['created_at'])?></span>
            <div class="comment_btns">
            <?php if ($role == 2 || $username === $row['username']) { ?>
              <a href="update_comment.php?id=<?php echo escape($row['id'])?>" class="comment__edit-btn">編輯</a>
              <a href="delete_comment.php?id=<?php echo escape($row['id'])?>" class="comment__del-btn">刪除</a>
            <?php } ?>
            </div>
          </div>
          <p class="comment__text"><?php echo escape($row['content'])?></p>
        </div>
      </div>
      <?php } ?>
    </section>
    <hr>
    <?php
      $sql = 'SELECT COUNT(id) AS count FROM jane_board_comments WHERE is_deleted = 0';
      $stmt = $conn -> prepare($sql);
      $result = $stmt -> execute();
      $result = $stmt -> get_result();
      $row = $result -> fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
    ?>
    <div class="page">
      <span>第 <?php echo escape($page)?> 頁，共 <?php echo escape($total_page)?> 頁</span>
    </div>
    <div class="paginator">
      <a href="index.php?page=1">首頁</a>
      <?php if ($page != 1) {?>
      <a href="index.php?page=<?php echo escape($page - 1); ?>">上一頁</a>
      <?php } ?>
      <?php if ($page != $total_page) {?>
      <a href="index.php?page=<?php echo escape($page + 1); ?>">下一頁</a>
      <?php } ?>
      <a href="index.php?page=<?php echo escape($total_page); ?>">最後一頁</a>
    </div>
  </main>
</body>
</html>
