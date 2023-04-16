<?php 
  session_start();
  require_once '../config.php';
  require_once '../functions.php';
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
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Login -->
    <div class="container mt-100">
      <div class="card mb-3">
        <div class="row g-0">
          <?php
            $event = $conn->query("SELECT ev.nama as namaevent, ev.created_on, ev.created_by, ac.nama as namauser FROM tb_event ev LEFT JOIN tb_account ac ON ev.created_by = ac.id ORDER BY created_on DESC");
            while ($rowEvent = $event->fetch_array()) :
          ?>
          <div class="col-12">
            <div class="card-body">
              <h5 class="card-title">Event</h5>
              <p class="card-text"><?=$rowEvent['namauser']?> membuat event bernama <?=$rowEvent['namaevent']?></p>
              <p class="card-text"><small class="text-muted"><?=format_datetime($rowEvent['created_on'],"-")?></small></p>
            </div>
          </div>
          <?php
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
