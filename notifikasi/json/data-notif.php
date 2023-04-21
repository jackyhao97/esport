<?php

session_start();

require_once('../../config.php');

require_once('../vendor/ssp.cls.php');

$counter = 0;


// function BuildCounter()
// {

//   global $counter;

//   $counter += 1;

//   return $counter;
// }

// function ShowImages($data, $nama) {
//   $component = '<a href="'.BASE_URL.DS.'admin/img/slider/'.$data.'" data-lightbox="'.$nama.'" data-title="'.$nama.'">';
//   $component .= '<img src="'.BASE_URL.DS.'admin/img/slider/'.$data.'" class="w-50" />';
//   $component .= "</a>";

//   return $component;
// }

function BuildAction($data) {
  // $component = '<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_verif" onclick="show('.$data.')" title="Ver"><i class="fa fa-edit"></i></a>';
  // $component .= "<br />";
  $component = '<a class="btn btn-sm btn-primary" onclick="initVerif('.$data.')" title="Verifikasi"><i class="fa-solid fa-check"></i></a>';

  return $component;
}


$table = <<<EOT
  (
    SELECT `id`, `is_verified`, `nama`, `history`, `created_on` FROM `tb_event` UNION ALL SELECT `id`, `is_active`, `nama`, `history`, `created_on` FROM `tb_post_eo` UNION ALL SELECT heo.`id`, heo.`harga_paket_id`, ac.`nama`, heo.`history`, heo.`created_on` FROM `tb_history_eo` heo LEFT JOIN `tb_account` ac ON heo.created_by = ac.id UNION ALL SELECT `id`, `event_id`, `history`, `history`, `created_on` FROM `tb_history_event` ORDER BY created_on DESC
  ) temp 
  EOT;



$primaryKey = 'id';

$func_apply = 'BuildCounter';

// $func_apply_2 = 'ShowImages';

$func_apply_3 = 'BuildAction';

$columns = array(

  // array(

  //   'db' => 'id',

  //   'dt' => 0,

  //   'formatter' => function () use ($func_apply) {

  //     return $func_apply();
  //   }

  // ),

  array(
    'db' => 'nama', 
    'dt' => 0,
    'formatter' => function($d, $row){
      if ($row[3] == 1)
        return "Event bernama $d";
      else if ($row[3] == 2)
        return "Posting EO bernama $d";
      else if ($row[3] == 3)
        return "User ikut event bernama $d";
      else
        return "User menyewa EO bernama $d";
    }
  ),
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
    'formatter' => function($d, $row) use ($func_apply_3) {
      return $func_apply_3($d);
    }
  ),
  array(
    'db' => 'history', 
    'dt' => 3,
    'formatter' => function($d, $row) {
      if ($d == 1)
        return "Event";
      else if ($d == 2)
        return "Event Organizer";
      else if ($d == 3)
        return "Register Event";
      else
        return "Sewa EO";
      }
  ),
  array('db' => 'nama', 'dt' => 4)
);


$sql_details = array(

  'user' => $username,

  'pass' => $password,

  'db' => $dbname,

  'host' => $servername

);

echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
