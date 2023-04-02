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
    <title>Event</title>
  </head>
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Banner -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <img src="<?=BASE_URL.DS.'assets/img/home/esports.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="col-12 mt-5">
          <button type="button" class="btn btn-outline-primary rounded-pill">HOT</button>
          <button type="button" class="btn btn-outline-primary rounded-pill">MOBA</button>
          <button type="button" class="btn btn-outline-primary rounded-pill">FPS</button>
          <button type="button" class="btn btn-outline-primary rounded-pill">Battle Royale</button>
          <button type="button" class="btn btn-outline-primary rounded-pill">Fighting</button>
          <button type="button" class="btn btn-outline-primary rounded-pill">TalkShow</button>
        </div>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
