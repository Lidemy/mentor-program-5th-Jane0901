<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_admin.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
  }

  if (empty($_GET['id'])) {
    header('Location: index.php');
    exit;
  }
  $id = $_GET['id'];

  $sql = 
    'SELECT
      A.id AS id, A.title AS title, A.content AS content, A.created_at AS created_at, A.username AS author,
      C.classname AS classname, C.id AS category_id
    FROM jane_blog_categories AS C
    LEFT JOIN jane_blog_articles AS A
    ON A.category = C.id
    WHERE A.id = ? AND A.is_deleted = 0
    ORDER BY A.id DESC
    ';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('s', $id);
  $result = $stmt -> execute();
  if (!$result) {
    die('Error:' . $conn -> error);
  }
  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
  if (empty($row) || $row['author'] !== $username) {
    header('Location: index.php');
  }

  $sql = 'SELECT id, classname FROM jane_blog_categories';
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
  <title>Who's Blog</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normalize.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
</head>
<body>
  <?php include_once('navbar.php');?>
  <div class="wrapper">
    <div class="banner">
      <h1 class="banner__title">存放技術之地</h1>
      <p>Welcome to my blog</p>
    </div>
    <main>
      <div class="edit-article">
        <h1 class="edit-article__title">編輯文章：</h1>
        <form method="post" action="handle_update_article.php">
          <input type="hidden" name="id" value="<?php echo escape($row['id'])?>">
          <div class="edit-post__input-wrapper">
           <input type="text" name="title" placeholder="請輸入文章標題..." value="<?php echo escape($row['title'])?>">
          </div>
          <div class="edit-post__input-wrapper">
            <select name="category" id="">
              <?php while($row_class = $result -> fetch_assoc()) { ?>
              <option value="<?php echo escape($row_class['id'])?>" <?php if($row_class['classname'] === $row['classname']) echo 'selected'?>><?php echo escape($row_class['classname'])?></option>
              <?php } ?>
            </select>
          </div class="edit-post__input-wrapper">
          <textarea class="require" id="editor" name="content">
            <?php echo $row['content']?>
          </textarea>
          <?php
              if ($_GET['errCode']) {
                $errCode = $_GET['errCode'];
                $msg = '錯誤';
                if ($errCode === "1") {
                  $msg = '標題、分類、內容不得空白';
                }
                echo '<p class="form__input-warning">' . $msg . '</p>';
              }
            ?>
          <div class="edit-post__btn-wrapper">
            <input  class="edit-post__btn" type="submit" value="送出文章">
          </div>
        </form>
      </div>
    </main>
  </div>
  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
  <script>
    ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .then( editor => {
        console.log( editor );
      })
      .catch( error => {
        console.error( error );
      })
  </script>
</body>
</html>
