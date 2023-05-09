<?php 
  require_once "../config.php";
  $data = '';

  if (isset($_POST["tipe"]))
  {
    $tipe = $_POST["tipe"];
    if ($tipe != "hot") {
      $result = $conn->query("SELECT * FROM tb_event WHERE genre_game = '$tipe' and is_verified = 1 ORDER BY id DESC");
      while ($row = $result->fetch_array())
      {
        $path = BASE_URL.DS.'assets/img/event/'.$row['path'];
        $nama = $row['nama'];
        $id = $row['id'];
        $data .= '<div class="col-12 col-md-6 mb-4 cursor-pointer" onclick="window.location=`detail.php?id=' .$id. '`">
                    <div class="card">
                      <img src="'.$path.'" class="card-img-top" alt="'.$nama.'">
                      <div class="card-body">
                        <p class="card-text fw-bold">'.$nama.'</p>
                      </div>
                    </div>
                  </div>';
      }
    }
    else {
      $user = $_POST["user"];
      $result = $conn->query("SELECT ev.nama, ev.path, ev.id as idevent, hb.bobot, hb.created_on FROM `tb_event` ev LEFT join tb_history_bobot hb ON ev.id = hb.event_id WHERE hb.created_by = '$user' and ev.is_verified = 1 ORDER BY bobot DESC, created_on DESC");
      while ($row = $result->fetch_array())
      {
        $path = BASE_URL.DS.'assets/img/event/'.$row['path'];
        $nama = $row['nama'];
        $id = $row['idevent'];
        $data .= '<div class="col-12 col-md-6 mb-4 cursor-pointer" onclick="window.location=`detail.php?id=' .$id. '`">
                    <div class="card">
                      <img src="'.$path.'" class="card-img-top" alt="'.$nama.'">
                      <div class="card-body">
                        <p class="card-text fw-bold">'.$nama.'</p>
                      </div>
                    </div>
                  </div>';
      }
    }
  }
  else
  {
    $data .= 'No Event.';
  }  
  $data .= '</div>';

  echo $data;
?>