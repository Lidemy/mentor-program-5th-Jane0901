<?php
  require_once('conn.php'); 
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (
    empty($_POST['site_key']) |
    empty($_POST['nickname']) |
    empty($_POST['content'])
  ) {
    $arr = array (
      'ok' => false,
      'message' => '資料不完整'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $site_key = $_POST['site_key'];
  $nickname = $_POST['nickname'];
  $content = $_POST['content'];

  $sql = 'INSERT INTO jane_discussions(site_key, nickname, content) VALUES(?, ?, ?)';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('sss', $site_key, $nickname, $content);
  $result = $stmt -> execute();

  if (!$result) {
    $arr = array (
      'ok' => false,
      'message' => '新增失敗'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $arr = array (
    'ok' => true,
    'message' => '新增成功'
  );
  $response = json_encode($arr);
  echo $response;
?>
