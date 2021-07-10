<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_GET['site_key'])) {
    $arr = array (
      'ok' => false,
      'message' => '請輸入網站來源'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $site_key = $_GET['site_key'];

  if (!$_GET['before']) {
    $sql = 'SELECT id FROM jane_discussions WHERE site_key = ? ORDER BY id DESC LIMIT 1';
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('s', $site_key);
    $result = $stmt -> execute();

    if (!$result) {
      $arr = array (
        'ok' => false,
        'message' => '取資料有問題'
      );
      $response = json_encode($arr);
      echo $response;
      die();
    }

    $result = $stmt -> get_result();
    $row = $result -> fetch_assoc();
    $before = $row['id'] + 1;
  } else {
    $before = $_GET['before'];
  }

  $sql = 'SELECT id, nickname, content, created_at FROM jane_discussions WHERE site_key = ? AND id < ? ORDER BY id DESC LIMIT 5';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('si', $site_key, $before);
  $result = $stmt -> execute();

  if (!$result) {
    $arr = array (
      'ok' => false,
      'message' => '取資料有問題'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }
  
  $result = $stmt -> get_result();
  $comments = array();
  while ($row = $result -> fetch_assoc()) {
    array_push($comments, array(
      'id' => $row['id'],
      'nickname' => $row['nickname'],
      'content' => $row['content'],
      'created_at' => $row['created_at']
    ));
  }

  $arr = array(
    'ok' => true,
    'comments' => $comments
  );
  $response = json_encode($arr);
  echo $response;
?>
