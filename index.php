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

    <!-- Tampilan untuk berita utama -->
    <div class="mt-5 container">
      <div class="row">
        <div class="col-12 mb-5">
          <h1 class="text-center fw-bold">Berita Utama</h1>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama/">
            <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama.webp'?>" class="d-block w-100" alt="Berita">
            <p class="fw-bold">Evil Geniuses Bakal Lepas Empat Roster League of Legends</p>
          </a>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama-2/">
            <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-2.webp'?>" class="d-block w-100" alt="Berita">
            <p class="fw-bold">RIOT GAMES Tampilkan Bundle Skin Baru VALORANT ARCADE</p>
          </a>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama-3/">
          <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-3.webp'?>" class="d-block w-100" alt="Berita">
            <p class="fw-bold">Even Esports Tekken World Tour Akan Perebutkan Hadiah 200.000 USD</p>
          </a>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama-4/">
            <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-4.webp'?>" class="d-block w-100" alt="Berita">
            <p class="fw-bold">Mau Lancar Main PUBGM di Smartphone Kentang, Ada PUBG MOBILE LITE Nih!</p>
          </a>
        </div>
      </div>
    </div>
    <!-- End -->

    <?php 
      require_once 'footer.php';
    ?>
  </body>
</html>
