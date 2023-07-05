<?php 
  require_once '../config.php';
  $res = [];

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
    $data = $conn->query("SELECT nama, tipe, jenis, prize_pool, max_slot, genre_game, lokasi, tgl_event_awal, tgl_event_akhir FROM tb_event WHERE id = '$id'");
    $row = $data->fetch_array(MYSQLI_ASSOC);
    $nama = $row['nama'];
    $tipe = $row['tipe'];
    $jenis = $row['jenis'];
    $prize_pool = $row['prize_pool'];
    $max_slot = $row['max_slot'];
    $genre_game = $row['genre_game'];
    $lokasi = $row['lokasi'];
    $tgl_event_awal = $row['tgl_event_awal'];
    $tgl_event_akhir = $row['tgl_event_akhir'];
	
    $hasil[] = [
      'hid_id' => $id,
      'nama' => $nama,
      'tipe' => $tipe,
      'jenis' => $jenis,
      'prize_pool' => $prize_pool,
      'max_slot' => $max_slot,
      'genre_game' => $genre_game,
      'lokasi' => $lokasi,
      'tgl_event_awal' => $tgl_event_awal,
      'tgl_event_akhir' => $tgl_event_akhir,
    ];

    array_push($hasil);

    $res = [
      'success' => 1,
      'data' => $hasil
    ];
	}
  else {
    $res = [
      'success' => 0
    ];
  }

	echo json_encode($res);
?>