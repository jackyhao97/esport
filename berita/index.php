<?php 
  require_once '../config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Berita Esports</title>
  </head>
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <div class="container mt-100">
      <div class="row">
        <div class="col-12 col-md-4">
          <h3 class="fw-bold">Berita Utama</h3>
          <div class="mt-5 overflow-auto" style="height: 100vh">
            <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="...">
            </a>
            <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100 mt-4" alt="...">
            </a>
            <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100 mt-4" alt="...">
            </a>
            <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100 mt-4" alt="...">
            </a>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <h3 class="fw-bold">Berita Hari ini</h3>
          <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="..." style="cursor:pointer">
                </a>
              </div>
              <div class="carousel-item">
                <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="...">
                </a>
              </div>
              <div class="carousel-item">
                <a href="./info-vct-pacific-league-2023-jadwal-format-dan-link-nonton/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.png'?>" class="d-block w-100" alt="...">
                </a>
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
        </div>
      </div>
    </div>
    
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
