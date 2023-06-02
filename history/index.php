<?php 
  session_start();
  require_once '../config.php';
  require_once '../functions.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../login/");
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>History</title>
  </head>
  <body>
    <?php 
      require_once '../navbar-white.php';
    ?>

    <!-- Tampilan History -->
    <div class="container mt-100">
      <div class="card mb-3">
        <div class="row g-0">
          <?php
            // Query untuk ambil history user yang bersangkutan
            // $event = $conn->query("SELECT ev.nama as namas, ev.created_on, ev.created_by, ac.nama as namauser, ev.history as history FROM tb_event ev LEFT JOIN tb_account ac ON ev.created_by = ac.id WHERE ev.created_by = $id UNION ALL SELECT po.nama as namas, po.created_on, po.created_by, ac.nama as namauser, po.history as history FROM tb_post_eo po LEFT JOIN tb_account ac ON po.created_by = ac.id WHERE po.created_by = $id ORDER BY created_on DESC");
            $event = $conn->query("SELECT ev.nama as namas, ev.created_on, ev.created_by, ac.nama as namauser, ev.history as history FROM tb_event ev LEFT JOIN tb_account ac ON ev.created_by = ac.id WHERE ev.created_by = $id UNION ALL SELECT po.nama as namas, po.created_on, po.created_by, ac.nama as namauser, po.history as history FROM tb_post_eo po LEFT JOIN tb_account ac ON po.created_by = ac.id WHERE po.created_by = $id UNION ALL SELECT eve.nama as namas, he.created_on, he.created_by, acc.nama as namauser, he.history as history FROM tb_history_event he LEFT JOIN tb_account acc ON he.created_by = acc.id LEFT JOIN tb_event eve ON he.event_id = eve.id WHERE he.created_by = $id ORDER BY created_on DESC");
            while ($rowEvent = $event->fetch_array()) :
              if ($rowEvent['history'] == 1) :
          ?>
          <!-- Untuk history segment event -->
          <div class="col-12">
            <div class="card-body" style="border-bottom: 1px solid #e1d8d8;">
              <h5 class="card-title fw-bold">Event</h5>
              <p class="card-text"><?=$rowEvent['namauser']?> membuat event bernama <?=$rowEvent['namas']?></p>
              <p class="card-text"><small class="text-muted"><?=format_datetime($rowEvent['created_on'],"-")?></small></p>
            </div>
          </div>
          <?php
              elseif ($rowEvent['history'] == 2) :
          ?>
          <!-- Untuk history segment event organizer -->
          <div class="col-12">
            <div class="card-body" style="border-bottom: 1px solid #e1d8d8;">
              <h5 class="card-title fw-bold">Event Organizer</h5>
              <p class="card-text"><?=$rowEvent['namauser']?> membuat EO bernama <?=$rowEvent['namas']?></p>
              <p class="card-text"><small class="text-muted"><?=format_datetime($rowEvent['created_on'],"-")?></small></p>
            </div>
          </div>
          <?php
              else :
          ?>
          <!-- Untuk history segment register event -->
          <div class="col-12">
            <div class="card-body" style="border-bottom: 1px solid #e1d8d8;">
              <h5 class="card-title fw-bold">Event</h5>
              <p class="card-text"><?=$rowEvent['namauser']?> register event bernama <?=$rowEvent['namas']?></p>
              <p class="card-text"><small class="text-muted"><?=format_datetime($rowEvent['created_on'],"-")?></small></p>
            </div>
          </div>
          <?php
              endif;
            endwhile;
          ?>
        </div>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
