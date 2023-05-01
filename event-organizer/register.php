<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$user = $_POST['user'];
		$hargapaket = $_POST['hargapaket'];
    $created_on = date('Y-m-d H:i:s');
    $data = $conn->query("INSERT INTO tb_history_eo (harga_paket_id, post_eo_id, history, created_by, created_on) VALUES ('$hargapaket', '$id', 4, '$user', '$created_on')");
	
		if ($data) {
      $res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>