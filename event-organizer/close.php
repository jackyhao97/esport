<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
    $data = $conn->query("DELETE FROM tb_post_eo WHERE id = '$id'");
	
		if ($data) {
      $res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>