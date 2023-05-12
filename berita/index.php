<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
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
            <a href="./berita-utama/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama.webp'?>" class="d-block w-100" alt="Berita">
              <p class="fw-bold">Evil Geniuses Bakal Lepas Empat Roster League of Legends</p>
            </a>
            <a href="./berita-utama-2/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-2.webp'?>" class="d-block w-100 mt-4" alt="Berita">
              <p class="fw-bold">RIOT GAMES Tampilkan Bundle Skin Baru VALORANT ARCADE</p>
            </a>
            <a href="./berita-utama-3/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-3.webp'?>" class="d-block w-100 mt-4" alt="Berita">
              <p class="fw-bold">Even Esports Tekken World Tour Akan Perebutkan Hadiah 200.000 USD</p>
            </a>
            <a href="./berita-utama-4/">
              <img src="<?=BASE_URL.DS.'assets/img/berita/berita-utama-4.webp'?>" class="d-block w-100 mt-4" alt="Berita">
              <p class="fw-bold">Mau Lancar Main PUBGM di Smartphone Kentang, Ada PUBG MOBILE LITE Nih!</p>
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
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner carousel-berita">
              <div class="carousel-item active">
                <a href="./berita-1/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/berita-1.webp'?>" class="d-block w-100" alt="Berita">
                  <div class="carousel-caption">
                    <p class="fw-bold">Mobile Legends Akan Rilis di China dengan Nama Win The Peak!</p>
                  </div>
                </a>
              </div>
              <div class="carousel-item">
                <a href="./berita-2/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/berita-2.webp'?>" class="d-block w-100" alt="Berita">
                  <div class="carousel-caption">
                    <p class="fw-bold">Cara Gabung ke Open Beta VALORANT Premier, Jadwal dan Persyaratan Mode Tournament</p>
                  </div>
                </a>
              </div>
              <div class="carousel-item">
                <a href="./berita-3/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/berita-3.webp'?>" class="d-block w-100" alt="Berita">
                  <div class="carousel-caption">
                    <p class="fw-bold">AE Okta Berbagi Tips Jadi Scout Handal di PUBG MOBILE</p>
                  </div>
                </a>
              </div>
              <div class="carousel-item">
                <a href="./berita-4/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/berita-4.webp'?>" class="d-block w-100" alt="Berita">
                  <div class="carousel-caption">
                    <p class="fw-bold">Tekken 7: Definitive Edition Bundle All Game Plus Konten Empat Musim</p>
                  </div>
                </a>
              </div>
              <div class="carousel-item">
                <a href="./berita-5/">
                  <img src="<?=BASE_URL.DS.'assets/img/berita/berita-5.jpeg'?>" class="d-block w-100" alt="Berita">
                  <div class="carousel-caption">
                    <p class="fw-bold">Aku Sih IES, Sebuah Program Talkshow Esports dari INDOESPORTS</p>
                  </div>
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
