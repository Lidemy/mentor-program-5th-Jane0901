<header class="navbar">
  <div class="navbar__left">
    <div class="navbar__blog-name" >
    <?php if ($blog) { ?>
      <a href="index.php?blog=<?php echo escape($blog)?>"><?php echo escape($blog)?>'s Blog</a>
      </div>
      <a class="navbar__btn" href="article_list.php?blog=<?php echo escape($blog)?>">文章列表</a>
    <?php } else { ?>
      <a href="index.php?blog=<?php echo escape($username)?>"><?php echo escape($username)?>'s Blog</a>
      </div>
      <a class="navbar__btn" href="article_list.php?blog=<?php echo escape($username)?>">文章列表</a>
    <?php } ?>
    <a class="navbar__btn" href="#">分類專區</a>
    <a class="navbar__btn" href="#">關於我</a>
  </div>
  <div class="navbar__right">
    <?php if(!$_SESSION['username']) { ?>
      <a class="navbar__btn" href="login.php?blog=<?php echo escape($blog)?>">登入</a>
    <?php } else { ?>
      <a class="navbar__btn" href="add_article.php">新增文章</a>
      <a class="navbar__btn" href="admin.php">管理後台</a>
      <?php if ($blog) { ?>
      <a class="navbar__btn" href="handle_logout.php?blog=<?php echo escape($blog)?>">登出</a>
      <?php } else { ?>
      <a class="navbar__btn" href="handle_logout.php?blog=<?php echo escape($username)?>">登出</a>
      <?php } ?>
    <?php } ?>
  </div>
</header>
