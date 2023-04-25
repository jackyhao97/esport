<?php 
  require_once "../config.php";
  
  if (isset($_POST["tipe"]))
  {
    $tipe = $_POST["tipe"];
    $result = $conn->query("SELECT * FROM tb_event WHERE genre_game = '$tipe' ORDER BY id DESC");
    while ($row = $result->fetch_array())
    {
      $path = BASE_URL.DS.'assets/img/event/'.$row['path'];
      $nama = $row['nama'];
      $id = $row['id'];
      $data = '<div class="col-12 col-md-6 mb-4 cursor-pointer" onclick="window.location=`detail.php?id=' .$id. '`">
                  <div class="card">
                    <img src="'.$path.'" class="card-img-top" alt="'.$nama.'">
                    <div class="card-body">
                      <p class="card-text fw-bold">'.$nama.'</p>
                    </div>
                  </div>
                </div>';
    }
  }
  else
  {
    $data .= 'No Event.';
  }  
  $data .= '</div>';

  echo $data;
?>