<?php 
  session_start();
  require_once '../config.php';
  $id = $_GET["id"];
  $user = $_SESSION['id'];
  $result = $conn->query("SELECT ev.id, ev.nama, ev.path, ev.prize_pool, ev.max_slot, ev.lokasi, ev.tgl_event_awal, ev.tgl_event_akhir, te.deskripsi, je.jenis FROM tb_event ev LEFT JOIN tb_tipe_event te ON ev.tipe = te.id LEFT JOIN tb_jenis_event je ON ev.jenis = je.id WHERE ev.id = '$id'");
  $row = $result->fetch_array();
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title><?=$row['nama']?></title>
  </head>
  <body>
    <?php
      require_once '../navbar.php';
    ?>

    <div class="container mt-100">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../">Event</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?=$row['nama']?></li>
        </ol>
      </nav>
      <img src="<?=BASE_URL.DS.'assets/img/event/'.$row['path']?>" alt="<?=$row['nama']?>" class="w-100">
      <h1 class="uk-margin-small fw-bold mt-5">
        <?=$row['nama']?>
      </h1>
      <p>
        Kabar gembira untuk para gamers mobile di Pulau Sumatera, karena <?=$row['nama']?> hadir untuk mewadahi kalian unjuk gigi dalam game kesayangan kalian, buruan daftar!
      </p>
      <p>
        Setelah melewati pandemi Covid-19 yang cukup lama, <?=$row['deskripsi']?> esports di berbagai daerah mulai berhilangan. Secara perlahan, satu per satu <?=$row['deskripsi']?> komunitas mulai muncul sebagai wadah para pemain game berkembang.
      </p>
      <p>
        <?=$row['nama']?> hadir untuk para pemain dengan membawa total hadiah sebesar <?=number_format($row['prize_pool'], 0, ',', '.')?>. <?=$row['deskripsi']?> ini akan diselenggarakan pada <?=date("d M Y", strtotime($row['tgl_event_awal']))?> sampai <?=date("d M Y", strtotime($row['tgl_event_akhir']))?> mendatang.
      </p>
      <p>
        Tertarik? Yuk lihat lebih detail mengenai <?=$row['deskripsi']?> yang besar ini!
      </p>
      <p class="fw-bold">
        Jadwal & Cara Mendaftarkan Diri di <?=$row['nama']?>
      </p>
      <p>
        <?=$row['deskripsi']?> ini bersifat <?=$row['jenis']?>. <?=$row['deskripsi']?> ini diselenggarakan pada <?=date("d M Y", strtotime($row['tgl_event_awal']))?> hingga <?=date("d M Y", strtotime($row['tgl_event_akhir']))?> di <?=$row['lokasi']?>.
      </p>
      <p>
        Bagi kalian yang sudah memiliki grup bermain dan merasa tertantang untuk membuktikkan skill, langsung saja jadi tim yang paling kuat di Pulau Sumatera dengan mendaftarkan diri di <?=$row['nama']?>.
      </p>
      <p>
        Tunggu apalagi, langsung daftarkan tim kalian, dan dapatkan hadiah sampai Rp <?=number_format($row['prize_pool'], 0, ',', '.')?> bersama <?=$row['nama']?>. Ingat slot terbatas loh maksimal hanya sampai <?=$row['max_slot']?> slot.
      </p>
      <p>
        Ikuti terus berita esports terbaru di Ligasport! Kunjungi Instagram dan Youtube Ligasport yang selalu update dan kekinian.
      </p>
      <div class="text-end mt-5">
        <a class="btn btn-lg btn-dark text-end" name="btn_register" id="btn_register" onclick="register(<?=$row['id']?>,<?=$user?>)">Register</a>
      </div>
    </div>

    <?php 
      require_once '../footer.php';
    ?>

    <script>
      function register(id, user) {
        const conf = confirm(`Apakah anda yakin untuk register di event ini?`);
        if (conf) {
          $.ajax({
            type: "post",
            url: "register.php",
            data: { id, user },
            success: (data) => {
              const res = $.parseJSON(data);

              if (res.success) {
                alert('Anda berhasil register event.');
              }
              else {
                alert('Anda gagal register event.');
              }
            }
          });
        }
      }
    </script>
  </body>
</html>
