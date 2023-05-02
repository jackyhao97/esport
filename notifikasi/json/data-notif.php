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

function BuildAction($data, $is_verified) {
  // $component = '<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_verif" onclick="show('.$data.')" title="Ver"><i class="fa fa-edit"></i></a>';
  // $component .= "<br />";

  $component = $is_verified == 0 ? '<a class="btn btn-sm btn-primary" onclick="initVerif('.$data.')" title="Verifikasi"><i class="fa-solid fa-check"></i></a>' : '';

  return $component;
}


$table = <<<EOT
  (
    SELECT 
      ev.`id`, ev.`is_verified`, ev.`nama`, ev.`history`, ev.`created_on`, ac.`nama` as user FROM `tb_event` ev 
    LEFT JOIN `tb_account` ac ON ev.created_by = ac.id 
    UNION ALL 
    SELECT 
      eo.`id`, eo.`is_active`, eo.`nama`, eo.`history`, eo.`created_on`, acc.`nama` as user FROM `tb_post_eo` eo 
    LEFT JOIN `tb_account` acc ON eo.created_by = acc.id 
    UNION ALL 
    SELECT 
      heo.`id`, heo.`harga_paket_id`, acco.`nama`, heo.`history`, heo.`created_on`, acco.`nama` as user FROM `tb_history_eo` heo 
    LEFT JOIN `tb_account` acco ON heo.created_by = acco.id
    UNION ALL 
    SELECT 
      he.`id`, he.`event_id`, he.`history`, he.`history`, he.`created_on`, accou.`nama` as user FROM `tb_history_event` he LEFT JOIN `tb_account` accou ON he.created_by = accou.id ORDER BY created_on DESC
  ) temp 
  EOT;



$primaryKey = 'id';

$func_apply = 'BuildCounter';

// $func_apply_2 = 'ShowImages';

$func_apply_3 = 'BuildAction';

$columns = array(
  array(
    'db' => 'nama', 
    'dt' => 0,
    'formatter' => function($d, $row){
      if ($row[1] == 1)
        return "$row[2] create event bernama $d";
      else if ($row[1] == 2)
        return "$row[2] posting EO bernama $d";
      else if ($row[1] == 3)
        return "$row[2] ikut event $d";
      else
        return "$row[2] menyewa EO bernama $d";
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
);


$sql_details = array(

  'user' => $username,

  'pass' => $password,

  'db' => $dbname,

  'host' => $servername

);

echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
