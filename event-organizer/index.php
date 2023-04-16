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
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 d-flex justify-content-between">
          <button type="button" class="btn btn-outline-primary rounded-pill">Recommended</button>
          <a href="./posting-eo/" class="btn btn-dark" name="btn_posting_eo" id="btn_posting_eo">Posting EO</a>
        </div>
        <div class="col-6 mt-5">
          <img src="<?=BASE_URL.DS.'assets/img/home/esports.jpg'?>" class="d-block w-100" alt="...">
          <div class="text-end">
            <input type="submit" class="btn btn-dark mt-3" name="btn_detail" value="Detail" id="btn_detail">
          </div>
        </div>
        <div class="col-6 mt-5">
          <img src="<?=BASE_URL.DS.'assets/img/home/esports.jpg'?>" class="d-block w-100" alt="...">
          <div class="text-end">
            <input type="submit" class="btn btn-dark mt-3" name="btn_detail" value="Detail" id="btn_detail">
          </div>
        </div>
        <div class="col-12 mt-5">
          <button type="button" class="btn btn-outline-primary rounded-pill">Newcomer</button>
        </div>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
