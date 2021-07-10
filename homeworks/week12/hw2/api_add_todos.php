<?php
  require_once('conn.php'); 
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_POST['todo'])) {
    $arr = array (
      'ok' => false,
      'message' => '資料不完整'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $todo = $_POST['todo'];
  
  $sql = 'INSERT INTO jane_todos(todo) VALUES (?)';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('s', $todo);
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
    'message' => '新增成功！',
    'id' => $conn -> insert_id
  );
  $response = json_encode($arr);
  echo $response;
?>
