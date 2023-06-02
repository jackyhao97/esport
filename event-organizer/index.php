<?php 
  session_start();
  require_once '../config.php';

  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../login/");

  // query tipe user untuk memastikan hanya user tipe EO yang bisa posting EO
  $querytipe = $conn->query("SELECT tu.tipe FROM `tb_account` ac LEFT JOIN `tb_tipe_user` tu ON ac.tipe = tu.id WHERE ac.id = '$id'");
  $rowtipe = $querytipe->fetch_array();
  $tipeuser = $rowtipe['tipe'];
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Event Organizer</title>
  </head>
  <body>
    <?php 
      require_once '../navbar-white.php';
    ?>

    <!-- Tampilan Recommended -->
    <div class="container mt-100">
      <div class="row">
        <div class="col-12 d-flex justify-content-end">
          <!-- <button type="button" class="btn btn-outline-primary rounded-pill">Recommended</button> -->
          <!-- Untuk user tipe event organizer saja yang bisa posting eo -->
          <?php 
            if ($tipeuser == "event-organizer") :
          ?>
          <a href="./posting-eo/" class="btn btn-dark" name="btn_posting_eo" id="btn_posting_eo">Posting EO</a>
          <?php
            endif;
          ?>
        </div>
        <?php
          $queryeo = $conn->query("SELECT * FROM `tb_post_eo` ORDER BY id DESC");
          while ($roweo = $queryeo->fetch_array()) :
        ?>
        <div class="col-6 mt-5">
          <img src="<?=BASE_URL.DS.'assets/img/event-organizer/'.$roweo['path']?>" class="d-block w-100" alt="<?=$roweo['nama']?>">
          <p class="fw-bold"><?=$roweo['nama']?></p>
          <div class="text-end">
            <a href="./detail.php?id=<?=$roweo['id']?>" class="btn btn-dark mt-3">Detail</a>
          </div>
        </div>
        <?php
          endwhile;
        ?>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
