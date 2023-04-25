<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$user = $_POST['user'];
    $created_on = date('Y-m-d H:i:s');
    $data = $conn->query("INSERT INTO tb_history_event (event_id, history, created_by, created_on) VALUES ('$id', 3, '$user', '$created_on')");
	
		if ($data) {
      $res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>