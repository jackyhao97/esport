<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
    $data = $conn->query("DELETE FROM tb_post_eo WHERE id = '$id'");
    $data2 = $conn->query("DELETE FROM tb_harga_paket WHERE post_eo_id = '$id'");
	
		if ($data && $data2) {
      $res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>