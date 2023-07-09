<?php

session_start();

require_once('../../config.php');

require_once('../../functions.php');

require_once('../vendor/ssp.cls.php');

$counter = 0;

$user = $_SESSION['id'];
$queryakun = $conn->query("SELECT ac.nama, tu.tipe FROM `tb_account` ac LEFT JOIN `tb_tipe_user` tu ON ac.tipe = tu.id WHERE ac.id = '$user'");
$rowakun = $queryakun->fetch_array();
$akunuser = $rowakun['nama'];
$tipeuser = $rowakun['tipe'];

// $user = "jeffry";

function BuildAction($data, $is_verified) {
  $component = $is_verified == 0 ? '<a class="btn btn-sm btn-primary" onclick="initVerif('.$data.')" title="Verifikasi"><i class="fa-solid fa-check"></i></a>' : '';

  return $component;
}

if ($tipeuser == "admin") {
  $table = <<<EOT
  (
    SELECT 
      ev.`id`, ev.`is_verified`, ev.`nama`, ev.`history`, ev.`created_on`, ac.`nama` as user, ac.`email`, ac.`nomor`, ev.`id` as custom, ev.`id` as paketa FROM `tb_event` ev 
    LEFT JOIN `tb_account` ac ON ev.created_by = ac.id
    UNION ALL 
    SELECT 
      eo.`id`, eo.`is_active`, eo.`nama`, eo.`history`, eo.`created_on`, acc.`nama` as user, acc.`email`, acc.`nomor`, eo.`id` as custom, eo.`id` as paketa FROM `tb_post_eo` eo 
    LEFT JOIN `tb_account` acc ON eo.created_by = acc.id
    UNION ALL
    SELECT 
      heo.`id`, heo.`harga_paket_id`, pe.`nama`, heo.`history`, heo.`created_on`, acco.`nama` as user, acco.`email`, acco.`nomor`, heo.`custom` as custom, CASE WHEN heo.`is_paket_a` = 1 THEN 'A' WHEN heo.`is_paket_a` = 0 AND heo.`custom` = '' THEN 'B' ELSE 'C' END as paketa FROM `tb_history_eo` heo 
    LEFT JOIN `tb_account` acco ON heo.created_by = acco.id LEFT JOIN `tb_post_eo` pe ON heo.post_eo_id = pe.id
    UNION ALL 
    SELECT 
      he.`id`, he.`event_id`, ev.`nama`, he.`history`, he.`created_on`, accou.`nama` as user, accou.`email`, accou.`nomor`, he.`id` as custom, he.`id` as paketa FROM `tb_history_event` he 
    LEFT JOIN `tb_account` accou ON he.created_by = accou.id 
    LEFT JOIN `tb_event` ev ON he.event_id = ev.id ORDER BY created_on DESC
  ) temp 
  EOT;
}
else {
  $table = <<<EOT
    (
      SELECT 
        ev.`id`, ev.`is_verified`, ev.`nama`, ev.`history`, ev.`created_on`, ac.`nama` as user, ac.`email`, ac.`nomor`,  ev.`id` as custom, ev.`id` as paketa FROM `tb_event` ev 
      LEFT JOIN `tb_account` ac ON ev.created_by = ac.id WHERE ac.nama = "$akunuser"
      UNION ALL 
      SELECT 
        eo.`id`, eo.`is_active`, eo.`nama`, eo.`history`, eo.`created_on`, acc.`nama` as user, acc.`email`, acc.`nomor`, eo.`id` as custom, eo.`id` as paketa FROM `tb_post_eo` eo 
      LEFT JOIN `tb_account` acc ON eo.created_by = acc.id WHERE acc.nama = "$akunuser"
      UNION ALL 
      SELECT 
        heo.`id`, heo.`harga_paket_id`, pe.`nama`, heo.`history`, heo.`created_on`, acco.`nama` as user, acco.`email`, acco.`nomor`,  heo.`custom` as custom, CASE WHEN heo.`is_paket_a` = 1 THEN 'A' ELSE 'B' END as paketa FROM `tb_history_eo` heo 
      LEFT JOIN `tb_account` acco ON heo.created_by = acco.id LEFT JOIN `tb_post_eo` pe ON heo.post_eo_id = pe.id WHERE acco.nama = "$akunuser"
      UNION ALL
      SELECT 
        he.id, ev.is_verified, ev.nama as namaevent, he.history, he.created_on, ac.nama as namauser, ac.`email`, ac.`nomor`, he.`id` as custom, he.`id` as paketa  FROM `tb_history_event` he LEFT JOIN `tb_event` ev ON he.event_id = ev.id LEFT JOIN `tb_account` ac ON he.created_by = ac.id WHERE ev.created_by = "$user"
      ORDER BY created_on DESC
    ) temp 
    EOT;
}

// Query dibawah untuk ambil register event yang dilakukan sendiri
// UNION ALL 
// SELECT 
//   he.`id`, he.`event_id`, ev.`nama`, he.`history`, he.`created_on`, accou.`nama` as user FROM `tb_history_event` he 
// LEFT JOIN `tb_account` accou ON he.created_by = accou.id 
// LEFT JOIN `tb_event` ev ON he.event_id = ev.id WHERE accou.nama = "$akunuser"



$primaryKey = 'id';

$func_apply = 'BuildCounter';

$func_apply_3 = 'BuildAction';

$columns = array(
  array(
    'db' => 'nama', 
    'dt' => 0,
    'formatter' => function($d, $row){
      if ($row[1] == 1)
        return "<a href='javascript:void(0)' target='_blank' title='detail' data-bs-toggle='modal' data-bs-target='#modalDetail' onclick='show(".$row[4].")'>$row[2] create event bernama $d</a>";
      else if ($row[1] == 2)
        return "$row[2] posting EO bernama $d";
      else if ($row[1] == 3)
        return "$row[2] ($row[7] - $row[6]) register event $d pada tanggal " . format_datetime($row[5]);
      else {
        if ($row[9] == 'C')
          return "$row[2] menyewa EO bernama $d dengan custom berisi $row[8]";
        else
          return "$row[2] menyewa EO bernama $d dengan paket $row[9]";
      }
    }
  ),
  array(
    'db' => 'history', 
    'dt' => 1,
    'formatter' => function($d, $row) {
      if ($d == 1)
        return "Create Event";
      else if ($d == 2)
        return "Event Organizer";
      else if ($d == 3)
        return "Register Event";
      else
        return "Sewa EO";
      }
  ),
  array('db' => 'user', 'dt' => 2),
  array(
    'db' => 'is_verified',
    'dt' => 3,
    'formatter' => function($d, $row){
      if ($row[1] == 1) {
        if ($d > 0)
          return '<i class="fa fa-check-circle fa-2x text-success"></i>';
        else
          return '<i class="fa fa-times-circle fa-2x text-danger"></i>';
      }
      else {
        return '';
      }
    }
  ),
  array(
    'db' => 'id', 
    'dt' => 4,
    'formatter' => function($d, $row) use ($func_apply_3) {
      if ($row[1] == 1)
        return $func_apply_3($d, $row[3]);
      else
        return '';
    }
  ),
  array('db' => 'created_on', 'dt' => 5),
  array('db' => 'nomor', 'dt' => 6),
  array('db' => 'email', 'dt' => 7),
  array('db' => 'custom', 'dt' => 8),
  array('db' => 'paketa', 'dt' => 9)
);


$sql_details = array(

  'user' => $username,

  'pass' => $password,

  'db' => $dbname,

  'host' => $servername

);

echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
