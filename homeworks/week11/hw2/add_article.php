<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_admin.php');

  $username = NULL;
  if ($_SESSION['username']) {
    $username = $_SESSION['username'];
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
        <h1 class="edit-article__title">發表文章：</h1>
        <form method="post" action="handle_add_article.php">
          <div class="edit-post__input-wrapper">
           <input class="require" type="text" name="title" placeholder="請輸入文章標題...">
           <p class="form__input-warning hide">標題不得空白</p>
          </div>
          <div class="edit-post__input-wrapper">
            <select class="require" name="category">
              <option value="" disabled selected hidden>請輸入文章分類</option>
              <?php while($row = $result -> fetch_assoc()) { ?>
              <option value="<?php echo escape($row['id'])?>"><?php echo escape($row['classname'])?></option>
              <?php } ?>
            </select>
            <p class="form__input-warning hide">分類不得空白</p>
          </div class="edit-post__input-wrapper">
          <textarea class="require" id="editor" name="content"></textarea>
          <p class="form__input-warning hide">內容不得空白</p>
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
    document
      .querySelector('.edit-article')
      .addEventListener('submit', e => {
        const elements = document.querySelectorAll('.require')
        for (const element of elements) {
          const warningMsg = element.nextSibling.nextElementSibling
          let isEmpty = element.value.length === 0 ? true : false

          if (isEmpty) {
            e.preventDefault()
            warningMsg.classList.remove('hide')
          } else {
            warningMsg.classList.add('hide')
          }
        }
      })
  </script>
</body>
</html>
