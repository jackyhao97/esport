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
    <title>Ligasport</title>
  </head>
  <body style="background: black;color: white;">
    <?php 
      require_once 'navbar.php';
    ?>

    <!-- Tampilan untuk carousel -->
    <div id="carouselExampleIndicators" class="carousel slide mt-50" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
      </div>
      <div class="carousel-inner carousel-custom carousel-home">
        <div class="carousel-item active" onclick="window.location='./berita/berita-1/'">
          <img src="<?=BASE_URL.DS.'assets/img/berita/berita-1.webp'?>" class="d-block w-100" alt="berita">
          <div class="carousel-caption">
            <p class="fw-bold">Mobile Legends Akan Rilis di China dengan Nama Win The Peak!</p>
          </div>
        </div>
        <div class="carousel-item" onclick="window.location='./berita/berita-2/'">
          <img src="<?=BASE_URL.DS.'assets/img/berita/berita-2.webp'?>" class="d-block w-100" alt="Berita">
          <div class="carousel-caption">
            <p class="fw-bold">Cara Gabung ke Open Beta VALORANT Premier, Jadwal dan Persyaratan Mode Tournament</p>
          </div>
        </div>
        <div class="carousel-item" onclick="window.location='./berita/berita-3/'">
          <img src="<?=BASE_URL.DS.'assets/img/berita/berita-3.webp'?>" class="d-block w-100" alt="Berita">
          <div class="carousel-caption">
            <p class="fw-bold">AE Okta Berbagi Tips Jadi Scout Handal di PUBG MOBILE s</p>
          </div>
        </div>

        <?php
          $queryevent = $conn->query("SELECT * FROM `tb_event` ORDER BY id DESC LIMIT 0,3");
          while ($rowevent = $queryevent->fetch_array()) :
        ?>
        <div class="carousel-item" onclick="window.location='./event/detail.php?id=<?=$rowevent['id']?>'">
          <img src="<?=BASE_URL.DS.'assets/img/event/'.$rowevent['path']?>" class="d-block w-100" alt="<?=$rowevent['nama']?>">
          <div class="carousel-caption">
            <p class="fw-bold"><?=$rowevent['nama']?></p>
          </div>
        </div>
        <?php
          endwhile;
        ?>
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
          <h1 class="text-center mmc-medium">Berita Utama</h1>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama/" class="text-decoration-none text-light">
            <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama.webp'?>" class="d-block w-100 card-berita" alt="Berita">
            <p class="fw-bold mt-3">Evil Geniuses Bakal Lepas Empat Roster League of Legends</p>
          </a>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama-2/" class="text-decoration-none text-light">
            <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-2.webp'?>" class="d-block w-100 card-berita" alt="Berita">
            <p class="fw-bold mt-3">RIOT GAMES Tampilkan Bundle Skin Baru VALORANT ARCADE</p>
          </a>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama-3/" class="text-decoration-none text-light">
          <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-3.webp'?>" class="d-block w-100 card-berita" alt="Berita">
            <p class="fw-bold mt-3">Even Esports Tekken World Tour Akan Perebutkan Hadiah 200.000 USD</p>
          </a>
        </div>
        <div class="col-12 col-md-3">
          <a href="./berita/berita-utama-4/" class="text-decoration-none text-light">
            <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-4.webp'?>" class="d-block w-100 card-berita" alt="Berita">
            <p class="fw-bold mt-3">Mau Lancar Main PUBGM di Smartphone Kentang, Ada PUBG MOBILE LITE Nih!</p>
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
