<?php
require_once '../config.php';
$res = [];

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$user = $_POST['user'];
	$rate = isset($_POST['txt_rate']) ? (float)$_POST['txt_rate'] : '';

	$fetch = $conn->query("SELECT rating, total FROM tb_rating WHERE event_id = '$id'");
	$fetchscore = $fetch->fetch_array();
	$score = (float)$fetchscore['rating'];
	$total = (int)$fetchscore['total'];
	$result_score = $rate + $score;
	$total_score = $total + 1;

	$data = $conn->query("UPDATE tb_rating SET rating = '$result_score', total = '$total_score' WHERE event_id = '$id'");

	if ($data) {
		$res['success'] = 1;
	} else {
		$res['success'] = 0;
	}
}

echo json_encode($res);
