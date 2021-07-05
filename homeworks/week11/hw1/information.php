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
    <h1 class="board__title">個人資料</h1>
    <?php
      if(!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'error';
        if($code === '1') {
          $msg = '未填寫暱稱';
        }
        echo '<p class="error">' . $msg . '</p>';
      }
    ?>
    <form class="board__information" method="post" action="handle_update_nickname.php">
      <div class="board__information-item">
        暱稱：<span class="toggle-hide"><?php echo escape($nickname);?> <button class="board__edit-btn">編輯</button></span>
        <input class="hide toggle-hide" type="text" name="nickname" value="<?php echo escape($nickname);?>">
      </div>
      <div class="board__information-item">
        帳號：<?php echo escape($username);?>
      </div>
      <div class="board__information-item">
        使用者狀態：<?php
        switch($role) {
          case 0:
            echo '遭停權使用者';
            break;
          case 1:
            echo '一般使用者';
            break;
          case 2:
            echo '管理員';
            break;
        }
        ?>
      </div>
      <button class="board__submit-btn hide toggle-hide">確定</button>
      <button class="board__cancel-btn hide toggle-hide">取消</button>
    </form>
  </main>
  <script>
    document.
      querySelector(".board__information").
      addEventListener('click', e => {
        const editBtn = document.querySelector('.board__edit-btn')
        const cancelBtn = document.querySelector('.board__cancel-btn')
        const toggleElem  = document.querySelectorAll('.toggle-hide')
        switch (e.target) {
          case editBtn:
            e.preventDefault()
            for (let i = 0; i < toggleElem.length; i ++) {
              toggleElem[i].classList.toggle('hide')
            }
            break
          case cancelBtn:
            e.preventDefault()
            window.location.href="information.php"
            break
        }
      })
  </script>
</body>
</html>
