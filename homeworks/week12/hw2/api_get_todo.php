<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_GET['id'])) {
    $arr = array (
      'ok' => false,
      'message' => '請加上 id'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $id = intval($_GET['id']);

  $sql = 'SELECT id, todo FROM jane_todos WHERE id = ?';
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param('i', $id);
  $result = $stmt -> execute();

  if (!$result) {
    $arr = array(
      'ok' => false,
      'message' => '取資料有問題'
    );
    $response = json_encode($arr);
    echo $response;
    die();
  }

  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
  $arr = array(
    'ok' => true,
    'data' => array(
      'id' => $row['id'],
      'todo' => $row['todo']
    )
  );
  $response = json_encode($arr);
  echo $response;
?>
