<?php

session_start();

require_once('../../config.php');

require_once('../../functions.php');

require_once('../vendor/ssp.cls.php');

$counter = 0;

$user = $_SESSION['id'];

$table = <<<EOT
(
  SELECT heo.id, ac.nama as namauser, eo.nama as namaeo, heo.created_on, heo.custom, CASE WHEN heo.`is_paket_a` = 1 THEN 'A' WHEN heo.`is_paket_a` = 0 AND heo.`custom` = '' THEN 'B' ELSE 'C' END as paketa FROM `tb_history_eo` heo LEFT JOIN `tb_post_eo` eo ON heo.post_eo_id = eo.id LEFT JOIN `tb_account` ac ON heo.created_by = ac.id WHERE eo.created_by = "$user"
) temp 
EOT;


$primaryKey = 'id';

$columns = array(
  array(
    'db' => 'namauser',
    'dt' => 0,
    'formatter' => function($d, $row){
      if ($row[4] == 'C')
        return "$d menyewa EO bernama $row[3] dengan custom berisi $row[2]";
      else
        return "$d menyewa EO bernama $row[3] dengan paket $row[4]";
    }
  ),
  array(
    'db' => 'created_on', 
    'dt' => 1,
    'formatter' => function($d, $row){
      return date('d-m-Y H:m', strtotime($d));
    }
  ),
  array('db' => 'custom', 'dt' => 2),
  array('db' => 'namaeo', 'dt' => 3),
  array('db' => 'paketa', 'dt' => 4)
);


$sql_details = array(

  'user' => $username,

  'pass' => $password,

  'db' => $dbname,

  'host' => $servername

);

echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
