<?php 
  session_start();
  require_once '../config.php';
  require_once '../library/TFIDF.php';
  require_once '../library/CosineSimilarity.php';

  $id = $_GET["id"];
  $user = $_SESSION['id'];
  $result = $conn->query("SELECT ev.id, ev.nama, ev.path, ev.prize_pool, ev.max_slot, ev.lokasi, ev.tgl_event_awal, ev.tgl_event_akhir, te.deskripsi, je.jenis FROM tb_event ev LEFT JOIN tb_tipe_event te ON ev.tipe = te.id LEFT JOIN tb_jenis_event je ON ev.jenis = je.id WHERE ev.id = '$id'");
  $row = $result->fetch_array();
  $nama = $row['nama'];
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
          <li class="breadcrumb-item"><a href="../event/">Event</a></li>
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

    <?php
      function textpreprocessing($inputText) {
        // Convert text to lowercase
        $inputText = strtolower($inputText);
    
        // Remove punctuation marks
        $inputText = preg_replace('/[^\w\s]/', '', $inputText);
    
        // Tokenize the text
        $tokens = explode(' ', $inputText);
    
        // Remove stopwords
        $stopwords = array('ada','adalah','adanya','adapun','agak','agaknya','agar','akan','akankah','akhir','akhiri','akhirnya','aku','akulah','amat','amatlah','anda','andalah','antar','antara','antaranya','apa','apaan','apabila','apakah','apalagi','apatah','artinya','asal','asalkan','atas','atau','ataukah','ataupun','awal','awalnya','bagai','bagaikan','bagaimana','bagaimanakah','bagaimanapun','bagi','bagian','bahkan','bahwa','bahwasanya','baik','bakal','bakalan','balik','banyak','bapak','baru','bawah','beberapa','begini','beginian','beginikah','beginilah','begitu','begitukah','begitulah','begitupun','bekerja','belakang','belakangan','belum','belumlah','benar','benarkah','benarlah','berada','berakhir','berakhirlah','berakhirnya','berapa','berapakah','berapalah','berapapun','berarti','berawal','berbagai','berdatangan','beri','berikan','berikut','berikutnya','berjumlah','berkali-kali','berkata','berkehendak','berkeinginan','berkenaan','berlainan','berlalu','berlangsung','berlebihan','bermacam','bermacam-macam','bermaksud','bermula','bersama','bersama-sama','bersiap','bersiap-siap','bertanya','bertanya-tanya','berturut','berturut-turut','bertutur','berujar','berupa','besar','betul','betulkah','biasa','biasanya','bila','bilakah','bisa','bisakah','boleh','bolehkah','bolehlah','buat','bukan','bukankah','bukanlah','bukannya','bulan','bung','cara','caranya','cukup','cukupkah','cukuplah','cuma','dahulu','dalam','dan','dapat','dari','daripada','datang','dekat','demi','demikian','demikianlah','dengan','depan','di','dia','diakhiri','diakhirinya','dialah','diantara','diantaranya','diberi','diberikan','diberikannya','dibuat','dibuatnya','didapat','didatangkan','digunakan','diibaratkan','diibaratkannya','diingat','diingatkan','diinginkan','dijawab','dijelaskan','dijelaskannya','dikarenakan','dikatakan','dikatakannya','dikerjakan','diketahui','diketahuinya','dikira','dilakukan','dilalui','dilihat','dimaksud','dimaksudkan','dimaksudkannya','dimaksudnya','diminta','dimintai','dimisalkan','dimulai','dimulailah','dimulainya','dimungkinkan','dini','dipastikan','diperbuat','diperbuatnya','dipergunakan','diperkirakan','diperlihatkan','diperlukan','diperlukannya','dipersoalkan','dipertanyakan','dipunyai','diri','dirinya','disampaikan','disebut','disebutkan','disebutkannya','disini','disinilah','ditambahkan','ditandaskan','ditanya','ditanyai','ditanyakan','ditegaskan','ditujukan','ditunjuk','ditunjuki','ditunjukkan','ditunjukkannya','ditunjuknya','dituturkan','dituturkannya','diucapkan','diucapkannya','diungkapkan','dong','dua','dulu','empat','enggak','enggaknya','entah','entahlah','guna','gunakan','hal','hampir','hanya','hanyalah','hari','harus','haruslah','harusnya','hendak','hendaklah','hendaknya','hingga','ia','ialah','ibarat','ibaratkan','ibaratnya','ibu','ikut','ingat','ingat-ingat','ingin','inginkah','inginkan','ini','inikah','inilah','itu','itukah','itulah','jadi','jadilah','jadinya','jangan','jangankan','janganlah','jauh','jawab','jawaban','jawabnya','jelas','jelaskan','jelaslah','jelasnya','jika','jikalau','juga','jumlah','jumlahnya','justru','kala','kalau','kalaulah','kalaupun','kalian','kami','kamilah','kamu','kamulah','kan','kapan','kapankah','kapanpun','karena','karenanya','kasus','kata','katakan','katakanlah','katanya','ke','keadaan','kebetulan','kecil','kedua','keduanya','keinginan','kelamaan','kelihatan','kelihatannya','kelima','keluar','kembali','kemudian','kemungkinan','kemungkinannya','kenapa','kepada','kepadanya','kesampaian','keseluruhan','keseluruhannya','keterlaluan','ketika','khususnya','kini','kinilah','kira','kira-kira','kiranya','kita','kitalah','kok','kurang','lagi','lagian','lah','lain','lainnya','lalu','lama','lamanya','lanjut','lanjutnya','lebih','lewat','lima','luar','macam','maka','makanya','makin','malah','malahan','mampu','mampukah','mana','manakala','manalagi','masa','masalah','masalahnya','masih','masihkah','masing','masing-masing','mau','maupun','melainkan','melakukan','melalui','melihat','melihatnya','memang','memastikan','memberi','memberikan','membuat','memerlukan','memihak','meminta','memintakan','memisalkan','memperbuat','mempergunakan','memperkirakan','memperlihatkan','mempersiapkan','mempersoalkan','mempertanyakan','mempunyai','memulai','memungkinkan','menaiki','menambahkan','menandaskan','menanti','menanti-nanti','menantikan','menanya','menanyai','menanyakan','mendapat','mendapatkan','mendatang','mendatangi','mendatangkan','menegaskan','mengakhiri','mengapa','mengatakan','mengatakannya','mengenai','mengerjakan','mengetahui','menggunakan','menghendaki','mengibaratkan','mengibaratkannya','mengingat','mengingatkan','menginginkan','mengira','mengucapkan','mengucapkannya','mengungkapkan','menjadi','menjawab','menjelaskan','menuju','menunjuk','menunjuki','menunjukkan','menunjuknya','menurut','menuturkan','menyampaikan','menyangkut','menyatakan','menyebutkan','menyeluruh','menyiapkan','merasa','mereka','merekalah','merupakan','meski','meskipun','meyakini','meyakinkan','minta','mirip','misal','misalkan','misalnya','mula','mulai','mulailah','mulanya','mungkin','mungkinkah','nah','naik','namun','nanti','nantinya','nyaris','nyatanya','oleh','olehnya','pada','padahal','padanya','pak','paling','panjang','pantas','para','pasti','pastilah','penting','pentingnya','per','percuma','perlu','perlukah','perlunya','pernah','persoalan','pertama','pertama-tama','pertanyaan','pertanyakan','pihak','pihaknya','pukul','pula','pun','punya','rasa','rasanya','rata','rupanya','saat','saatnya','saja','sajalah','saling','sama','sama-sama','sambil','sampai','sampai-sampai','sampaikan','sana','sangat','sangatlah','satu','saya','sayalah','se','sebab','sebabnya','sebagai','sebagaimana','sebagainya','sebagian','sebaik','sebaik-baiknya','sebaiknya','sebaliknya','sebanyak','sebegini','sebegitu','sebelum','sebelumnya','sebenarnya','seberapa','sebesar','sebetulnya','sebisanya','sebuah','sebut','sebutlah','sebutnya','secara','secukupnya','sedang','sedangkan','sedemikian','sedikit','sedikitnya','seenaknya','segala','segalanya','segera','seharusnya','sehingga','seingat','sejak','sejauh','sejenak','sejumlah','sekadar','sekadarnya','sekali','sekali-kali','sekalian','sekaligus','sekalipun','sekarang','sekarang','sekecil','seketika','sekiranya','sekitar','sekitarnya','sekurang-kurangnya','sekurangnya','sela','selain','selaku','selalu','selama','selama-lamanya','selamanya','selanjutnya','seluruh','seluruhnya','semacam','semakin','semampu','semampunya','semasa','semasih','semata','semata-mata','semaunya','sementara','semisal','semisalnya','sempat','semua','semuanya','semula','sendiri','sendirian','sendirinya','seolah','seolah-olah','seorang','sepanjang','sepantasnya','sepantasnyalah','seperlunya','seperti','sepertinya','sepihak','sering','seringnya','serta','serupa','sesaat','sesama','sesampai','sesegera','sesekali','seseorang','sesuatu','sesuatunya','sesudah','sesudahnya','setelah','setempat','setengah','seterusnya','setiap','setiba','setibanya','setidak-tidaknya','setidaknya','setinggi','seusai','sewaktu','siap','siapa','siapakah','siapapun','sini','sinilah','soal','soalnya','suatu','sudah','sudahkah','sudahlah','supaya','tadi','tadinya','tahu','tahun','tak','tambah','tambahnya','tampak','tampaknya','tandas','tandasnya','tanpa','tanya','tanyakan','tanyanya','tapi','tegas','tegasnya','telah','tempat','tengah','tentang','tentu','tentulah','tentunya','tepat','terakhir','terasa','terbanyak','terdahulu','terdapat','terdiri','terhadap','terhadapnya','teringat','teringat-ingat','terjadi','terjadilah','terjadinya','terkira','terlalu','terlebih','terlihat','termasuk','ternyata','tersampaikan','tersebut','tersebutlah','tertentu','tertuju','terus','terutama','tetap','tetapi','tiap','tiba','tiba-tiba','tidak','tidakkah','tidaklah','tiga','tinggi','toh','tunjuk','turut','tutur','tuturnya','ucap','ucapnya','ujar','ujarnya','umum','umumnya','ungkap','ungkapnya','untuk','usah','usai','waduh','wah','wahai','waktu','waktunya','walau','walaupun','wong','yaitu','yakin','yakni','yang'
        );
        $tokens = array_diff($tokens, $stopwords);
    
        // Perform stemming (optional)
        // $stemmer = new TextStatistics();
        // foreach ($tokens as &$token) {
        //     $token = $stemmer->stemWord($token);
        // }
    
        // Convert tokens back to text
        $preprocessedText = implode(' ', $tokens);
    
        // Output preprocessed text
        return $preprocessedText;
      }

      // delete history
      $querydelete = $conn->query("DELETE FROM tb_history_bobot WHERE created_by = $user");

      // Input documents
      $queryevent = $conn->query("SELECT * FROM tb_event ORDER BY id DESC");
      $now = date("Y-m-d H:i:s");
      while ($rowevent = $queryevent->fetch_array()) {
        $idevent = $rowevent['id'];
        $namaevent = $rowevent['nama'];

        //Create TF-IDF objects for each document
        $tfidfnow = new TFIDF(textpreprocessing($nama));
        $tfidfother = new TFIDF(textpreprocessing($namaevent));

        // Get TF-IDF scores for each document
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
