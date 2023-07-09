<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$user = $_POST['user'];
		$hargapaket = $_POST['hargapaket'];
		$is_paket_a = isset($_POST['paketa']) ? $_POST['paketa'] : 0;
		$customdesc = $_POST['custom'];
    $created_on = date('Y-m-d H:i:s');

		$custom = ($hargapaket == 0) ? $customdesc : '';

    $data = $conn->query("INSERT INTO tb_history_eo (harga_paket_id, post_eo_id, history, created_by, created_on, custom, is_paket_a) VALUES ('$hargapaket', '$id', 4, '$user', '$created_on', '$custom', '$is_paket_a')");
	
		if ($data) {
      $res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>