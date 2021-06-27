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

  if ($user === NULL || $role !== 2) {
    header('Location: index.php');
    exit;
  }

  $sql = 'SELECT id, nickname, username, role FROM jane_board_users';
  $stmt = $conn -> prepare($sql);
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
      <a class="board__btn" href="index.php">回留言板</a>
      <a class="board__btn" href="logout.php">登出</a>
    </div>
    <h1 class="board__title">管理使用者身份</h1>
    <table class="board__users">
      <tr>
        <th>ID</th>
        <th>帳號</th>
        <th>暱稱</th>
        <th>身份</th>
      </tr>
      <?php while($row = $result->fetch_assoc()) { ?>
      <form method="post" action="handle_update_role.php">
      <tr>
        <td><?php echo escape($row['id'])?>
        <input type="hidden" name="id" value="<?php echo escape($row['id'])?>">
        </td>
        <td><?php echo escape($row['username'])?></td>
        <td><?php echo escape($row['nickname'])?></td>
        <td class="table__role">
          <select name="role">
            <option value="2" <?php if($row['role'] == 2) echo 'selected' ?>>管理員</option>
            <option value="1" <?php if($row['role'] == 1) echo 'selected' ?>>一般使用者</option>
            <option value="0" <?php if($row['role'] == 0) echo 'selected' ?>>遭停權使用者</option>
          </select>
          <input type="submit" class="board__edit-btn" value="更新"></input>
        </td>
      </tr>
      </form>
      <?php } ?>
    </table>
  </main>
</body>
</html>
