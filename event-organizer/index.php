<?php 
  session_start();
  require_once '../config.php';
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
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Recommended -->
    <div class="container mt-100">
      <div class="row">
        <div class="col-12 d-flex justify-content-end">
          <!-- <button type="button" class="btn btn-outline-primary rounded-pill">Recommended</button> -->
          <a href="./posting-eo/" class="btn btn-dark" name="btn_posting_eo" id="btn_posting_eo">Posting EO</a>
        </div>
        <?php
          $queryeo = $conn->query("SELECT * FROM `tb_post_eo` ORDER BY id DESC");
          while ($roweo = $queryeo->fetch_array()) :
        ?>
        <div class="col-6 mt-5">
          <img src="<?=BASE_URL.DS.'assets/img/event-organizer/'.$roweo['path']?>" class="d-block w-100" alt="<?=$roweo['nama']?>">
          <div class="text-end">
            <input type="submit" class="btn btn-dark mt-3" name="btn_detail" value="Detail" id="btn_detail">
          </div>
        </div>
        <?php
          endwhile;
        ?>
        <!-- <div class="col-12 mt-5">
          <button type="button" class="btn btn-outline-primary rounded-pill">Newcomer</button>
        </div> -->
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
