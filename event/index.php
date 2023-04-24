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
      <div class="row mt-5">
        <div class="col-12 col-md-6">
          <div class="card">
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" class="card-img-top" alt="Event">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" class="card-img-top" alt="Event">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" class="card-img-top" alt="Event">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" class="card-img-top" alt="Event">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" class="card-img-top" alt="Event">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" class="card-img-top" alt="Event">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
