<?php
  require_once('conn.php'); 
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_POST['todo']) | empty($_POST['id'])) {
    $arr = array (
      'ok' => false,
      'message' => '資料不完整'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $id = $_POST['id'];
  $todo = $_POST['todo'];
  
  $sql = 'UPDATE jane_todos SET todo = ? WHERE id = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('si', $todo, $id);
  $result = $stmt -> execute();

  if (!$result) {
    $arr = array (
      'ok' => false,
      'message' => '更新失敗'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $arr = array (
    'ok' => true,
    'message' => '更新成功！',
    'id' => $id
  );
  $response = json_encode($arr);
  echo $response;
?>
