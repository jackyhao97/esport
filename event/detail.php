<?php
session_start();
require_once '../config.php';
require_once '../library/TFIDF.php';
require_once '../library/CosineSimilarity.php';

$id = $_GET["id"];
$user = $_SESSION['id'];

// Query tipe user
$querytipe = $conn->query("SELECT tu.tipe FROM `tb_account` ac LEFT JOIN `tb_tipe_user` tu ON ac.tipe = tu.id WHERE ac.id = '$user'");
$rowtipe = $querytipe->fetch_array();
$tipeuser = $rowtipe['tipe'];

// Query detail event
$result = $conn->query("SELECT ev.id, ev.nama, ev.path, ev.prize_pool, ev.max_slot, ev.lokasi, ev.tgl_event_awal, ev.tgl_event_akhir, te.deskripsi, je.jenis, ev.created_by as usercreated FROM tb_event ev LEFT JOIN tb_tipe_event te ON ev.tipe = te.id LEFT JOIN tb_jenis_event je ON ev.jenis = je.id WHERE ev.id = '$id'");
$row = $result->fetch_array();
$nama = $row['nama'];
$usercreated = $row['usercreated'];
?>

<!doctype html>
<html lang="en">

<head>
  <?php
  require_once '../header.php';
  ?>
  <title><?= $row['nama'] ?></title>
</head>

<body>
  <?php
  require_once '../navbar-white.php';
  ?>

  <div class="container mt-100">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-between">
        <div class="d-flex">
          <li class="breadcrumb-item" style="background: #efefef;padding: 10px;border-radius: 10px 0 0 10px;"><a href="./"><i class="fa-solid fa-calendar" style="color: #676161;"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page" style="background: #efefef;padding: 10px;border-radius: 0 10px 10px 0;"><?= $row['nama'] ?></li>
        </div>
        <div class="">
          <a class="btn btn-dark text-end" name="btn_rate" id="btn_rate" data-bs-toggle="modal" data-bs-target="#modalRate">Rate</a>

          <?php
          if ($usercreated == $user) :
          ?>
            <button type="button" class="btn btn-dark" onclick="closeEvent(<?= $row['id'] ?>)">Close Event</button>
          <?php
          endif;
          ?>
        </div>
      </ol>
    </nav>
    <img src="<?= BASE_URL . DS . 'assets/img/event/' . $row['path'] ?>" alt="<?= $row['nama'] ?>" class="w-100">
    <h1 class="uk-margin-small fw-bold mt-5">
      <?= $row['nama'] ?>
    </h1>
    <p>
      Kabar gembira untuk para gamers mobile di Pulau Sumatera, karena <?= $row['nama'] ?> hadir untuk mewadahi kalian unjuk gigi dalam game kesayangan kalian, buruan daftar!
    </p>
    <p>
      Setelah melewati pandemi Covid-19 yang cukup lama, <?= $row['deskripsi'] ?> esports di berbagai daerah mulai berhilangan. Secara perlahan, satu per satu <?= $row['deskripsi'] ?> komunitas mulai muncul sebagai wadah para pemain game berkembang.
    </p>
    <p>
      <?php
      if ($row['deskripsi'] == "Tournament") :
      ?>
        <?= $row['nama'] ?> hadir untuk para pemain dengan membawa total hadiah sebesar <?= number_format($row['prize_pool'], 0, ',', '.') ?>.
      <?php
      else :
      ?>
        <?= $row['nama'] ?> hadir untuk para pemain setia yang ingin terus ikut update terbaru.
      <?php
      endif;
      ?>
      <?= $row['deskripsi'] ?> ini akan diselenggarakan pada <?= date("d M Y", strtotime($row['tgl_event_awal'])) ?> sampai <?= date("d M Y", strtotime($row['tgl_event_akhir'])) ?> mendatang.
    </p>
    <p>
      Tertarik? Yuk lihat lebih detail mengenai <?= $row['deskripsi'] ?> yang besar ini!
    </p>
    <p class="fw-bold">
      Jadwal & Cara Mendaftarkan Diri di <?= $row['nama'] ?>
    </p>
    <p>
      <?= $row['deskripsi'] ?> ini bersifat <?= $row['jenis'] ?>. <?= $row['deskripsi'] ?> ini diselenggarakan pada <?= date("d M Y", strtotime($row['tgl_event_awal'])) ?> hingga <?= date("d M Y", strtotime($row['tgl_event_akhir'])) ?> di <?= $row['lokasi'] ?>.
    </p>
    <?php
    if ($row['deskripsi'] == "Tournament") :
    ?>
      <p>
        Bagi kalian yang sudah memiliki grup bermain dan merasa tertantang untuk membuktikkan skill, langsung saja jadi tim yang paling kuat di Pulau Sumatera dengan mendaftarkan diri di <?= $row['nama'] ?>.
      </p>
    <?php
    else :
    ?>
      <p>
        Bagi kalian yang sudah memiliki grup bermain, bisa yuk mengajak temannya untuk mengikuti acara <?= $row['nama'] ?> secara <?= $row['jenis'] ?>.
      </p>
    <?php
    endif;
    ?>
    <?php
    if ($row['deskripsi'] == "Tournament") :
    ?>
      <p>
        Tunggu apalagi, langsung daftarkan tim kalian, dan dapatkan hadiah sampai Rp <?= number_format($row['prize_pool'], 0, ',', '.') ?> bersama <?= $row['nama'] ?>. Ingat slot terbatas loh maksimal hanya sampai <?= $row['max_slot'] ?> slot.
      </p>
    <?php
    endif;
    ?>
    <p>
      Ikuti terus berita esports terbaru di Ligasport! Kunjungi Instagram dan Youtube Ligasport yang selalu update dan kekinian.
    </p>
    <div class="text-end mt-5">
      <?php
      $event_id = $row['id'];
      $queryregister = $conn->query("SELECT * FROM `tb_history_event` WHERE event_id = '$event_id' and created_by = '$user'");
      $rowcount = mysqli_num_rows($queryregister);

      if ($rowcount == 0) {
        if ($_SESSION['tipe'] != "3") {
      ?>
          <a class="btn btn-lg btn-dark text-end" name="btn_register" id="btn_register" data-bs-toggle="modal" data-bs-target="#modalRegister">Register</a>
      <?php
        }
      }
      ?>

      <!-- Modal -->
      <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalRegisterLabel">Register Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" method="post" id="frm_register">
              <div class="modal-body">
                <div class="row mb-3 align-items-center">
                  <label for="txt_nama" class="form-label col-sm-3 text-center">Nama</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txt_nama" name="txt_nama" required="required">
                  </div>
                </div>
                <div class="row mb-3 align-items-center">
                  <label for="txt_email" class="form-label col-sm-3 text-center">Email</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="txt_email" name="txt_email" required="required">
                  </div>
                </div>
                <div class="row mb-3 align-items-center">
                  <label for="txt_no_hp" class="form-label col-sm-3 text-center">No HP</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txt_no_hp" name="txt_no_hp" required="required">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="register(<?= $row['id'] ?>,<?= $user ?>)">Register</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalRate" tabindex="-1" aria-labelledby="modalRateLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalRateLabel">Rate Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" method="post" id="frm_rate_event">
              <div class="modal-body">
                <div class="row mb-3 align-items-center">
                  <label for="txt_rate" class="form-label col-sm-3 text-center">Rate</label>
                  <div class="col-sm-8">
                    <div class="rate">
                      <input type="radio" id="star5" name="txt_rate" value="5" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="txt_rate" value="4" />
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="txt_rate" value="3" />
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="txt_rate" value="2" />
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="txt_rate" value="1" />
                      <label for="star1" title="text">1 star</label>
                    </div>
                    <!-- <select class="form-select" aria-label="Default select example" id="txt_rate" name="txt_rate">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select> -->
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="rateEvent(<?= $row['id'] ?>,<?= $user ?>)">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>
  </div>

  <?php
  require_once '../footer.php';
  ?>

  <script>
    $("#modalRegister").on("shown.bs.modal", function() {
      $("#txt_nama").focus();
    });

    // untuk register event
    function register(id, user) {
      const conf = confirm(`Apakah anda yakin untuk register di event ini?`);

      if (conf) {
        if ($("#txt_nama").val() == '') {
          alert('Harap mengisi nama!');
        } else if ($("#txt_email").val() == '') {
          alert('Harap mengisi email!');
        } else if ($("#txt_no_hp").val() == '') {
          alert('Harap mengisi no hp!');
        } else {
          const formData = new FormData(document.getElementById("frm_register"));
          formData.append('id', id);
          formData.append('user', user);
          $.ajax({
            type: "post",
            url: "register.php",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
              const res = $.parseJSON(data);

              if (res.success) {
                alert('Anda berhasil register event.');
                $("#modalRegister").modal("hide");
                location.reload();
              } else {
                alert('Anda gagal register event. Silahkan coba lagi.');
              }
            }
          });
        }
      }
    }

    // Untuk rate event
    function rateEvent(id, user) {
      const conf = confirm(`Rate event ini?`);

      if (conf) {
        const formData = new FormData(document.getElementById("frm_rate_event"));
        formData.append('id', id);
        formData.append('user', user);
        $.ajax({
          type: "post",
          url: "rate.php",
          data: formData,
          processData: false,
          contentType: false,
          success: (data) => {
            const res = $.parseJSON(data);

            if (res.success) {
              alert('Anda berhasil rate event ini.');
              $("#modalRate").modal("hide");
              location.reload();
            } else {
              alert('Anda gagal rate event ini. Silahkan coba lagi.');
            }
          }
        });
      }
    }

    // untuk close event
    function closeEvent(id) {
      console.log('ok');
      const conf = confirm(`Apakah anda yakin untuk menutup event ini?`);

      if (conf) {
        $.ajax({
          type: "post",
          url: "close.php",
          data: {
            id
          },
          success: (data) => {
            const res = $.parseJSON(data);

            if (res.success) {
              alert('Anda berhasil menutup event.');
              window.location = '../event';
            } else {
              alert('Anda gagal menutup event. Silahkan coba lagi.');
            }
          }
        });
      }
    }

    // untuk delete event hanya untuk role admin
    // function deleteEvent(id) {
    //   const conf = confirm(`Apakah anda yakin untuk hapus event ini?`);
    //   if (conf) {
    //     $.ajax({
    //       type: "post",
    //       url: "delete.php",
    //       data: { id },
    //       success: (data) => {
    //         const res = $.parseJSON(data);

    //         if (res.success) {
    //           alert('Event berhasil dihapus.');
    //           window.location = '../event/';
    //         }
    //         else {
    //           alert('Event gagal dihapus.');
    //         }
    //       }
    //     });
    //   }
    // }
  </script>

  <?php
  // untuk sanitasi kata yang dihitung cosine similarity
  function textpreprocessing($inputText)
  {
    // Convert text to lowercase
    $inputText = strtolower($inputText);

    // Remove punctuation marks
    $inputText = preg_replace('/[^\w\s]/', '', $inputText);

    // Tokenize the text
    $tokens = explode(' ', $inputText);

    // Remove stopwords
    $stopwords = array(
      'ada', 'adalah', 'adanya', 'adapun', 'agak', 'agaknya', 'agar', 'akan', 'akankah', 'akhir', 'akhiri', 'akhirnya', 'aku', 'akulah', 'amat', 'amatlah', 'anda', 'andalah', 'antar', 'antara', 'antaranya', 'apa', 'apaan', 'apabila', 'apakah', 'apalagi', 'apatah', 'artinya', 'asal', 'asalkan', 'atas', 'atau', 'ataukah', 'ataupun', 'awal', 'awalnya', 'bagai', 'bagaikan', 'bagaimana', 'bagaimanakah', 'bagaimanapun', 'bagi', 'bagian', 'bahkan', 'bahwa', 'bahwasanya', 'baik', 'bakal', 'bakalan', 'balik', 'banyak', 'bapak', 'baru', 'bawah', 'beberapa', 'begini', 'beginian', 'beginikah', 'beginilah', 'begitu', 'begitukah', 'begitulah', 'begitupun', 'bekerja', 'belakang', 'belakangan', 'belum', 'belumlah', 'benar', 'benarkah', 'benarlah', 'berada', 'berakhir', 'berakhirlah', 'berakhirnya', 'berapa', 'berapakah', 'berapalah', 'berapapun', 'berarti', 'berawal', 'berbagai', 'berdatangan', 'beri', 'berikan', 'berikut', 'berikutnya', 'berjumlah', 'berkali-kali', 'berkata', 'berkehendak', 'berkeinginan', 'berkenaan', 'berlainan', 'berlalu', 'berlangsung', 'berlebihan', 'bermacam', 'bermacam-macam', 'bermaksud', 'bermula', 'bersama', 'bersama-sama', 'bersiap', 'bersiap-siap', 'bertanya', 'bertanya-tanya', 'berturut', 'berturut-turut', 'bertutur', 'berujar', 'berupa', 'besar', 'betul', 'betulkah', 'biasa', 'biasanya', 'bila', 'bilakah', 'bisa', 'bisakah', 'boleh', 'bolehkah', 'bolehlah', 'buat', 'bukan', 'bukankah', 'bukanlah', 'bukannya', 'bulan', 'bung', 'cara', 'caranya', 'cukup', 'cukupkah', 'cukuplah', 'cuma', 'dahulu', 'dalam', 'dan', 'dapat', 'dari', 'daripada', 'datang', 'dekat', 'demi', 'demikian', 'demikianlah', 'dengan', 'depan', 'di', 'dia', 'diakhiri', 'diakhirinya', 'dialah', 'diantara', 'diantaranya', 'diberi', 'diberikan', 'diberikannya', 'dibuat', 'dibuatnya', 'didapat', 'didatangkan', 'digunakan', 'diibaratkan', 'diibaratkannya', 'diingat', 'diingatkan', 'diinginkan', 'dijawab', 'dijelaskan', 'dijelaskannya', 'dikarenakan', 'dikatakan', 'dikatakannya', 'dikerjakan', 'diketahui', 'diketahuinya', 'dikira', 'dilakukan', 'dilalui', 'dilihat', 'dimaksud', 'dimaksudkan', 'dimaksudkannya', 'dimaksudnya', 'diminta', 'dimintai', 'dimisalkan', 'dimulai', 'dimulailah', 'dimulainya', 'dimungkinkan', 'dini', 'dipastikan', 'diperbuat', 'diperbuatnya', 'dipergunakan', 'diperkirakan', 'diperlihatkan', 'diperlukan', 'diperlukannya', 'dipersoalkan', 'dipertanyakan', 'dipunyai', 'diri', 'dirinya', 'disampaikan', 'disebut', 'disebutkan', 'disebutkannya', 'disini', 'disinilah', 'ditambahkan', 'ditandaskan', 'ditanya', 'ditanyai', 'ditanyakan', 'ditegaskan', 'ditujukan', 'ditunjuk', 'ditunjuki', 'ditunjukkan', 'ditunjukkannya', 'ditunjuknya', 'dituturkan', 'dituturkannya', 'diucapkan', 'diucapkannya', 'diungkapkan', 'dong', 'dua', 'dulu', 'empat', 'enggak', 'enggaknya', 'entah', 'entahlah', 'guna', 'gunakan', 'hal', 'hampir', 'hanya', 'hanyalah', 'hari', 'harus', 'haruslah', 'harusnya', 'hendak', 'hendaklah', 'hendaknya', 'hingga', 'ia', 'ialah', 'ibarat', 'ibaratkan', 'ibaratnya', 'ibu', 'ikut', 'ingat', 'ingat-ingat', 'ingin', 'inginkah', 'inginkan', 'ini', 'inikah', 'inilah', 'itu', 'itukah', 'itulah', 'jadi', 'jadilah', 'jadinya', 'jangan', 'jangankan', 'janganlah', 'jauh', 'jawab', 'jawaban', 'jawabnya', 'jelas', 'jelaskan', 'jelaslah', 'jelasnya', 'jika', 'jikalau', 'juga', 'jumlah', 'jumlahnya', 'justru', 'kala', 'kalau', 'kalaulah', 'kalaupun', 'kalian', 'kami', 'kamilah', 'kamu', 'kamulah', 'kan', 'kapan', 'kapankah', 'kapanpun', 'karena', 'karenanya', 'kasus', 'kata', 'katakan', 'katakanlah', 'katanya', 'ke', 'keadaan', 'kebetulan', 'kecil', 'kedua', 'keduanya', 'keinginan', 'kelamaan', 'kelihatan', 'kelihatannya', 'kelima', 'keluar', 'kembali', 'kemudian', 'kemungkinan', 'kemungkinannya', 'kenapa', 'kepada', 'kepadanya', 'kesampaian', 'keseluruhan', 'keseluruhannya', 'keterlaluan', 'ketika', 'khususnya', 'kini', 'kinilah', 'kira', 'kira-kira', 'kiranya', 'kita', 'kitalah', 'kok', 'kurang', 'lagi', 'lagian', 'lah', 'lain', 'lainnya', 'lalu', 'lama', 'lamanya', 'lanjut', 'lanjutnya', 'lebih', 'lewat', 'lima', 'luar', 'macam', 'maka', 'makanya', 'makin', 'malah', 'malahan', 'mampu', 'mampukah', 'mana', 'manakala', 'manalagi', 'masa', 'masalah', 'masalahnya', 'masih', 'masihkah', 'masing', 'masing-masing', 'mau', 'maupun', 'melainkan', 'melakukan', 'melalui', 'melihat', 'melihatnya', 'memang', 'memastikan', 'memberi', 'memberikan', 'membuat', 'memerlukan', 'memihak', 'meminta', 'memintakan', 'memisalkan', 'memperbuat', 'mempergunakan', 'memperkirakan', 'memperlihatkan', 'mempersiapkan', 'mempersoalkan', 'mempertanyakan', 'mempunyai', 'memulai', 'memungkinkan', 'menaiki', 'menambahkan', 'menandaskan', 'menanti', 'menanti-nanti', 'menantikan', 'menanya', 'menanyai', 'menanyakan', 'mendapat', 'mendapatkan', 'mendatang', 'mendatangi', 'mendatangkan', 'menegaskan', 'mengakhiri', 'mengapa', 'mengatakan', 'mengatakannya', 'mengenai', 'mengerjakan', 'mengetahui', 'menggunakan', 'menghendaki', 'mengibaratkan', 'mengibaratkannya', 'mengingat', 'mengingatkan', 'menginginkan', 'mengira', 'mengucapkan', 'mengucapkannya', 'mengungkapkan', 'menjadi', 'menjawab', 'menjelaskan', 'menuju', 'menunjuk', 'menunjuki', 'menunjukkan', 'menunjuknya', 'menurut', 'menuturkan', 'menyampaikan', 'menyangkut', 'menyatakan', 'menyebutkan', 'menyeluruh', 'menyiapkan', 'merasa', 'mereka', 'merekalah', 'merupakan', 'meski', 'meskipun', 'meyakini', 'meyakinkan', 'minta', 'mirip', 'misal', 'misalkan', 'misalnya', 'mula', 'mulai', 'mulailah', 'mulanya', 'mungkin', 'mungkinkah', 'nah', 'naik', 'namun', 'nanti', 'nantinya', 'nyaris', 'nyatanya', 'oleh', 'olehnya', 'pada', 'padahal', 'padanya', 'pak', 'paling', 'panjang', 'pantas', 'para', 'pasti', 'pastilah', 'penting', 'pentingnya', 'per', 'percuma', 'perlu', 'perlukah', 'perlunya', 'pernah', 'persoalan', 'pertama', 'pertama-tama', 'pertanyaan', 'pertanyakan', 'pihak', 'pihaknya', 'pukul', 'pula', 'pun', 'punya', 'rasa', 'rasanya', 'rata', 'rupanya', 'saat', 'saatnya', 'saja', 'sajalah', 'saling', 'sama', 'sama-sama', 'sambil', 'sampai', 'sampai-sampai', 'sampaikan', 'sana', 'sangat', 'sangatlah', 'satu', 'saya', 'sayalah', 'se', 'sebab', 'sebabnya', 'sebagai', 'sebagaimana', 'sebagainya', 'sebagian', 'sebaik', 'sebaik-baiknya', 'sebaiknya', 'sebaliknya', 'sebanyak', 'sebegini', 'sebegitu', 'sebelum', 'sebelumnya', 'sebenarnya', 'seberapa', 'sebesar', 'sebetulnya', 'sebisanya', 'sebuah', 'sebut', 'sebutlah', 'sebutnya', 'secara', 'secukupnya', 'sedang', 'sedangkan', 'sedemikian', 'sedikit', 'sedikitnya', 'seenaknya', 'segala', 'segalanya', 'segera', 'seharusnya', 'sehingga', 'seingat', 'sejak', 'sejauh', 'sejenak', 'sejumlah', 'sekadar', 'sekadarnya', 'sekali', 'sekali-kali', 'sekalian', 'sekaligus', 'sekalipun', 'sekarang', 'sekarang', 'sekecil', 'seketika', 'sekiranya', 'sekitar', 'sekitarnya', 'sekurang-kurangnya', 'sekurangnya', 'sela', 'selain', 'selaku', 'selalu', 'selama', 'selama-lamanya', 'selamanya', 'selanjutnya', 'seluruh', 'seluruhnya', 'semacam', 'semakin', 'semampu', 'semampunya', 'semasa', 'semasih', 'semata', 'semata-mata', 'semaunya', 'sementara', 'semisal', 'semisalnya', 'sempat', 'semua', 'semuanya', 'semula', 'sendiri', 'sendirian', 'sendirinya', 'seolah', 'seolah-olah', 'seorang', 'sepanjang', 'sepantasnya', 'sepantasnyalah', 'seperlunya', 'seperti', 'sepertinya', 'sepihak', 'sering', 'seringnya', 'serta', 'serupa', 'sesaat', 'sesama', 'sesampai', 'sesegera', 'sesekali', 'seseorang', 'sesuatu', 'sesuatunya', 'sesudah', 'sesudahnya', 'setelah', 'setempat', 'setengah', 'seterusnya', 'setiap', 'setiba', 'setibanya', 'setidak-tidaknya', 'setidaknya', 'setinggi', 'seusai', 'sewaktu', 'siap', 'siapa', 'siapakah', 'siapapun', 'sini', 'sinilah', 'soal', 'soalnya', 'suatu', 'sudah', 'sudahkah', 'sudahlah', 'supaya', 'tadi', 'tadinya', 'tahu', 'tahun', 'tak', 'tambah', 'tambahnya', 'tampak', 'tampaknya', 'tandas', 'tandasnya', 'tanpa', 'tanya', 'tanyakan', 'tanyanya', 'tapi', 'tegas', 'tegasnya', 'telah', 'tempat', 'tengah', 'tentang', 'tentu', 'tentulah', 'tentunya', 'tepat', 'terakhir', 'terasa', 'terbanyak', 'terdahulu', 'terdapat', 'terdiri', 'terhadap', 'terhadapnya', 'teringat', 'teringat-ingat', 'terjadi', 'terjadilah', 'terjadinya', 'terkira', 'terlalu', 'terlebih', 'terlihat', 'termasuk', 'ternyata', 'tersampaikan', 'tersebut', 'tersebutlah', 'tertentu', 'tertuju', 'terus', 'terutama', 'tetap', 'tetapi', 'tiap', 'tiba', 'tiba-tiba', 'tidak', 'tidakkah', 'tidaklah', 'tiga', 'tinggi', 'toh', 'tunjuk', 'turut', 'tutur', 'tuturnya', 'ucap', 'ucapnya', 'ujar', 'ujarnya', 'umum', 'umumnya', 'ungkap', 'ungkapnya', 'untuk', 'usah', 'usai', 'waduh', 'wah', 'wahai', 'waktu', 'waktunya', 'walau', 'walaupun', 'wong', 'yaitu', 'yakin', 'yakni', 'yang'
    );

    // Ambil yang berbeda, hilangkan kata yang ada di stopwords
    $tokens = array_diff($tokens, $stopwords);

    // Convert tokens back to text
    $preprocessedText = implode(' ', $tokens);

    // Output preprocessed text
    return $preprocessedText;
  }

  // delete history agar pembacaan dimulai dari awal
  $querydelete = $conn->query("DELETE FROM tb_history_bobot WHERE created_by = $user");

  // Input documents
  $queryevent = $conn->query("SELECT * FROM tb_event ORDER BY id DESC");
  $now = date("Y-m-d H:i:s");
  while ($rowevent = $queryevent->fetch_array()) {
    $idevent = $rowevent['id'];
    $namaevent = $rowevent['nama'];

    //Create TF-IDF objects for each document, belum dapat hasil
    $tfidfnow = new TFIDF(textpreprocessing($nama));
    $tfidfother = new TFIDF(textpreprocessing($namaevent));

    // Get TF-IDF scores for each document karena ada return hasil
    $tfidfScoresNow = $tfidfnow->getTFIDF();
    $tfidfScoresOther = $tfidfother->getTFIDF();

    // Create CosineSimilarity object
    $cosineSimilarity = new CosineSimilarity($tfidfScoresNow, $tfidfScoresOther);

    // Calculate cosine similarity between the two documents
    $similarity = $cosineSimilarity->calculateCosineSimilarity();

    // Output the cosine similarity score
    // echo "Cosine Similarity dari \"$nama\" dengan \"$namaevent\" : " . $similarity . "<br>";

    $queryinsert = $conn->query("INSERT INTO tb_history_bobot (event_id, bobot, created_on, created_by) VALUES ('$idevent', '$similarity', '$now', '$user')");


    // query untuk show data
    // SELECT hb.id as idhistory, ev.id as idevent, ev.nama, ev.path, hb.bobot, hb.created_on FROM `tb_event` ev LEFT join tb_history_bobot hb ON ev.id = hb.event_id ORDER BY bobot DESC, hb.id DESC, created_on DESC
  }
  ?>
</body>

</html>