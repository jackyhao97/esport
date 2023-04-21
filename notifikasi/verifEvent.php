<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
    $update = $conn->query("UPDATE tb_event SET is_verified = 1 WHERE id = $id");
	
		if ($update) {
			$res['success'] = 1;
		}
		else {
			$res['success'] = 0;
		}
	}

	echo json_encode($res);
?>