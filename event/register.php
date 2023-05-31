<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$user = $_POST['user'];
		$email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';
		$nama = isset($_POST['txt_nama']) ? $_POST['txt_nama'] : '';
		$nohp = isset($_POST['txt_no_hp']) ? $_POST['txt_no_hp'] : '';
    $created_on = date('Y-m-d H:i:s');
    $data = $conn->query("INSERT INTO tb_history_event (event_id, history, created_by, created_on, nama, email, nohp) VALUES ('$id', 3, '$user', '$created_on', '$nama', '$email', '$nohp')");
	
		if ($data) {
      $res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>