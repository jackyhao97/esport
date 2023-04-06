<?php 
  session_start();
  require_once 'config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once 'header.php';
    ?>
    <title>Esports</title>
  </head>
  <body>
    <?php 
      require_once 'navbar.php';
    ?>

    <!-- Tampilan untuk carousel -->
    <div id="carouselExampleIndicators" class="carousel slide mt-50" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner carousel-custom">
        <div class="carousel-item active">
          <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- End -->

    <?php 
      require_once 'footer.php';
    ?>
  </body>
</html>
