<?php 
  session_start();
  require_once '../../config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../../header.php';
    ?>
    <title>Login Esports</title>
  </head>
  <body>
    <?php 
      require_once '../../navbar.php';
    ?>

    <div class="container mt-5">
      <img src="<?=BASE_URL.DS.'assets/img/berita/vct-pacific.webp'?>" alt="VCT Pacific" class="w-50 mb-5">
      <p>Valorant Champions Tour (VCT) Pacific League 2023 akan segera dimulai. Liga regional ini akan diikuti 10 tim partner franchise VALORANT dari Asia-Pasifik. Selain memperebutkan trofi dan hadiah uang, empat tim teratas akan berlaga di VCT Masters Tokyo. Inilah semua yang perlu kami ketahui tentang liga VCT Pacific 2023 termasuk skor langsung, kedudukan grup, format, peserta, dan banyak lagi.</p>

      <p>VCT Pacific akan menggunakan sistem kompetisi Liga dengan format single round-robin yang akan berlangsung selama delapan minggu.  Semua pertandingan adalah seri terbaik dari tiga (BO-3). Berikut adalah beberapa format VCT Pacific League.</p>

      <p>Babak Grup
      Enam besar maju ke babak playoff
      Empat tim terbawah tersingkir
      Babak penyisihan grup berlangsung dari 25 Maret - 16 Mei 2023.
      Pertandingan penyisihan grup berakhir pada 16 Mei 2023. Babak playoff akan dimulai segera setelah itu, pada 19 Mei 2023. Babak playoff berlangsung selama sepuluh hari yang berakhir pada 28 Mei. Pertandingan akan disiarkan langsung setiap hari Sabtu, Minggu, dan Senin.</p>

      <img src="<?=BASE_URL.DS.'assets/img/berita/playoffs.webp'?>" alt="Playoffs" class="w-50 mb-5">

      <p>Playoff (Jangchung Arena)
      Semua pertandingan kecuali tiga final adalah seri best-of-three.
      Final braket atas, final braket bawah, dan pertandingan Grand Final adalah seri best-of-five.
      Dua tim teratas dari grup melaju ke babak semifinal UB.
      Empat tim tersisa melaju ke babak perempat final UB
      Tiga tim teratas dari VCT Pacific melaju ke Tokyo Masters 2023. Setelah beberapa acara sukses di Jepang tahun lalu, antusiasme untuk VCT Masters Tokyo selalu tinggi. Esports.gg juga akan memberikan liputan eksklusif seputar VCT Masters Tokyo.</p>

      <h1 class="fw-bold">Team VCT Pacific League 2023</h1>

      <img src="<?=BASE_URL.DS.'assets/img/berita/team-vct-pacific-league.jpg'?>" alt="Team VCT" class="w-50 mb-5">

      <p> Berikut roster tim VCT Pacific League 2023 </p>

      <img src="<?=BASE_URL.DS.'assets/img/berita/list-vct.jpg'?>" alt="List VCT" class="w-50 mb-5">
    </div>
    <?php 
      require_once '../../footer.php';
    ?>
  </body>
</html>
