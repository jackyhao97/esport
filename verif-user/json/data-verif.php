<?php

session_start();

require_once('../../config.php');

require_once('../../functions.php');

require_once('../vendor/ssp.cls.php');

$counter = 0;


function BuildAction($data, $is_verified) {
  $component = $is_verified == 0 ? '<a class="btn btn-sm btn-primary" onclick="initUserVerif('.$data.')" title="Verifikasi User"><i class="fa-solid fa-check"></i></a>' : '';

  return $component;
}


function BuildAction2($data, $is_verified) {
  $component = $is_verified == 0 ? '<a class="btn btn-sm btn-danger" onclick="initCancelVerif('.$data.')" title="Verifikasi User"><i class="fa-solid fa-times"></i></a>' : '';

  return $component;
}


$table = <<<EOT
(
  SELECT id, nama, username, is_verified FROM `tb_account`
) temp 
EOT;


$primaryKey = 'id';

$func_apply = 'BuildAction';

$func_apply_2 = 'BuildAction2';

$columns = array(
  array('db' => 'nama', 'dt' => 0),
  array(
    'db' => 'is_verified',
    'dt' => 1,
    'formatter' => function($d, $row){
      if ($d > 0)
        return '<i class="fa fa-check-circle fa-2x text-success"></i>';
      else
        return '<i class="fa fa-times-circle fa-2x text-danger"></i>';
    }
  ),
  array(
    'db' => 'id', 
    'dt' => 2,
    'formatter' => function($d, $row) use ($func_apply) {
      return $func_apply($d, $row[1]);
    }
  ),
  array(
    'db' => 'id', 
    'dt' => 3,
    'formatter' => function($d, $row) use ($func_apply_2) {
      return $func_apply_2($d, $row[1]);
    }
  ),
);


$sql_details = array(

  'user' => $username,

  'pass' => $password,

  'db' => $dbname,

  'host' => $servername

);

echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
