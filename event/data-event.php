<?php
require_once "../config.php";
$data = '';

if (isset($_POST["tipe"])) {
  $tipe = $_POST["tipe"];
  // untuk tipe selain hot
  if ($tipe != "hot") {
    $result = $conn->query("SELECT ev.nama, ev.path, ev.id as idevent, rt.rating, rt.total FROM tb_event ev LEFT JOIN tb_rating rt ON ev.id = rt.event_id WHERE genre_game = '$tipe' and is_verified = 1 ORDER BY ev.id DESC");
    while ($row = $result->fetch_array()) {
      $path = BASE_URL . DS . 'assets/img/event/' . $row['path'];
      $nama = $row['nama'];
      $id = $row['idevent'];
      $rating = $row['rating'] / $row['total'];
      $rating = number_format($rating, 1, '.', ' ');
      $data .= '<div class="col-12 col-md-6 mb-4 cursor-pointer" onclick="window.location=`detail.php?id=' . $id . '`">
                    <div class="card">
                      <img src="' . $path . '" class="card-img-top" alt="' . $nama . '">
                      <div class="card-body">
                        <p class="card-text">Rating : ' . $rating . '/5</p>
                        <p class="card-text fw-bold">' . $nama . '</p>
                      </div>
                    </div>
                  </div>';
    }
  } else {
    // untuk menarik data pada kategori hot
    $user = $_POST["user"];
    $result = $conn->query("SELECT ev.nama, ev.path, ev.id as idevent, hb.bobot, rt.rating, hb.created_on, rt.total FROM `tb_event` ev LEFT join tb_history_bobot hb ON ev.id = hb.event_id LEFT JOIN tb_rating rt ON ev.id = rt.event_id WHERE hb.created_by = '$user' and ev.is_verified = 1 ORDER BY bobot DESC, rating DESC, created_on DESC");
    // SELECT ev.nama, ev.path, ev.id as idevent, hb.bobot, hb.created_on FROM `tb_event` ev LEFT join tb_history_bobot hb ON ev.id = hb.event_id WHERE hb.created_by = '$user' and ev.is_verified = 1 ORDER BY bobot DESC, created_on DESC
    while ($row = $result->fetch_array()) {
      $path = BASE_URL . DS . 'assets/img/event/' . $row['path'];
      $nama = $row['nama'];
      $id = $row['idevent'];
      $rating = $row['rating'] / $row['total'];
      $rating = number_format($rating, 1, '.', ' ');
      $data .= '<div class="col-12 col-md-6 mb-4 cursor-pointer" onclick="window.location=`detail.php?id=' . $id . '`">
                    <div class="card">
                      <img src="' . $path . '" class="card-img-top" alt="' . $nama . '">
                      <div class="card-body">
                        <p class="card-text">Rating : ' . $rating . '/5</p>
                        <p class="card-text fw-bold">' . $nama . '</p>
                      </div>
                    </div>
                  </div>';
    }
  }
} else {
  $data .= 'No Event.';
}
$data .= '</div>';

echo $data;
