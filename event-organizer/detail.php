<?php 
  session_start();
  require_once '../config.php';
  require_once '../functions.php';

  $id = $_GET["id"];
  $user = $_SESSION['id'];

  // Query untuk ambil detail event organizer
  $result = $conn->query("SELECT pe.id as ideo, nama, jenis_eo, is_custom, path, history, tipe, deskripsi, created_on, created_by FROM `tb_post_eo` pe LEFT JOIN `tb_tipe_event` te ON pe.jenis_eo = te.id WHERE pe.id = '$id'");
  $row = $result->fetch_array();
  $usercreated = $row["created_by"];
  $resultuser = $conn->query("SELECT * FROM `tb_account` WHERE id = '$user'");
  $rowuser = $resultuser->fetch_array();
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Event Organizer <?=$row['nama']?></title>
  </head>
  <body>
    <?php
      require_once '../navbar-white.php';
    ?>

    <div class="container mt-100 text-end ml-auto">
      <?php
        if ($usercreated == $user) :
      ?>
      <div class="">
        <button type="button" class="btn btn-dark" onclick="deleteEo(<?=$row['ideo']?>)">Delete EO</button>
      </div>
      <?php
        endif;
      ?>
    </div>

    <div class="container mt-3 p-3" style="background:#eee">
      <div class="row">
        <div class="col-12">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item" style="background: #efefef;padding: 10px;border-radius: 10px 0 0 10px;"><a href="../event-organizer/"><i class="fa-regular fa-calendar-check" style="color: #676161;"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page" style="background: #efefef;padding: 10px;border-radius: 0 10px 10px 0;"><?=$row['nama']?></li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="row">
            <div class="col-12">
              <img src="<?=BASE_URL.DS.'assets/img/event-organizer/'.$row['path']?>" alt="<?=$row['nama']?>" class="w-100">
            </div>
            <div class="col-12 mt-3">
              <div class="row">
              <?php 
                $resultharga = $conn->query("SELECT * FROM `tb_harga_paket` WHERE post_eo_id = '$id' and is_paket_a = 1");
                $rowharga = $resultharga->fetch_array();
              ?>
                <div class="col-12 col-md-6">
                  <div class="card border-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                      <div>
                        Paket A
                      </div>
                      <div>
                        <input class="form-check-input radiopaket" type="radio" name="radioNoLabel" id="radioNoLabel1" value="<?=$rowharga['id'].'|'.$rowharga['is_paket_a']?>" aria-label="...">
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Dekorasi : Rp <?=number_format($rowharga['dekorasi_a'], 0, ",", ".");?></p>
                      <p class="card-text">Event : Rp <?=number_format($rowharga['event_a'], 0, ",", ".");?></p>
                      <p class="card-text">Panggung : Rp <?=number_format($rowharga['panggung_a'], 0, ",", ".");?></p>
                      <p class="card-text">Total : Rp <?=number_format($rowharga['total_a'], 0, ",", ".");?></p>
                    </div>
                  </div>
                </div>
              <?php 
                $resultharga = $conn->query("SELECT * FROM `tb_harga_paket` WHERE post_eo_id = '$id' and is_paket_a = 0");
                $rowharga = $resultharga->fetch_array();
              ?>
                <div class="col-12 col-md-6">
                  <div class="card border-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                      <div>
                        Paket B
                      </div>
                      <div>
                        <input class="form-check-input radiopaket" type="radio" name="radioNoLabel" id="radioNoLabel1" value="<?=$rowharga['id'].'|'.$rowharga['is_paket_a']?>?>" aria-label="...">
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Dekorasi : Rp <?=number_format($rowharga['dekorasi_b'], 0, ",", ".");?></p>
                      <p class="card-text">Event : Rp <?=number_format($rowharga['event_b'], 0, ",", ".");?></p>
                      <p class="card-text">Panggung : Rp <?=number_format($rowharga['panggung_b'], 0, ",", ".");?></p>
                      <p class="card-text">Total : Rp <?=number_format($rowharga['total_b'], 0, ",", ".");?></p>
                    </div>
                  </div>
                </div>
              <?php
                if ($row['is_custom'] == 1) :
              ?>
                <div class="col-12">
                  <div class="card border-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                      <div>
                        Custom
                      </div>
                      <div>
                        <input class="form-check-input radiopaket" type="radio" name="radioNoLabel" id="radioNoLabel1" value="0" aria-label="...">
                      </div>
                    </div>
                    <div class="card-body">
                      <textarea class="form-control txt_custom" aria-label="Harga Paket Custom" id="txt_custom" name="txt_custom" rows='5' required></textarea>
                    </div>
                  </div>
                </div>
              <?php
                endif;
              ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <img src="<?=BASE_URL.DS.'assets/img/profile/'.$rowuser['path']?>" alt="<?=$rowuser['nama']?>" class="img-user">
            </div>
            <div class="col-12 bg-light p-3 mt-3">
              <p class="fw-bold"><?=$row['nama']?></p>
              <p><?=$row['deskripsi']?></p>
            </div>
          </div>
        </div>
      </div>
      

      <div class="text-end mt-5">
        <a class="btn btn-lg btn-dark text-end" name="btn_register" id="btn_register" onclick="register(<?=$row['ideo']?>,<?=$user?>)">Register</a>
      </div>
    </div>

    <?php
      require_once '../footer.php';
    ?>

    <script>
      function register(id, user) {
        // value hargapaket = 0 artinya custom
        var hargapaketraw = $(".radiopaket:checked").val();
        var custom = $(".txt_custom").val();
        hargapaketnew = hargapaketraw.split("|");
        var hargapaket = hargapaketnew[0];
        var paketa = hargapaketnew[1];
        
        if (hargapaketraw == undefined) {
          alert('Paket belum dipilih!');
        }
        else {
          const conf = confirm(`Apakah anda yakin untuk register untuk event organizer ini?`);
          if (conf) {
            $.ajax({
              type: "post",
              url: "register.php",
              data: { id, user, hargapaket, custom, paketa },
              success: (data) => {
                const res = $.parseJSON(data);
  
                if (res.success) {
                  alert('Anda berhasil register EO.');
                }
                else {
                  alert('Anda gagal register EO.');
                }
              }
            });
          }
        }
      }

      // untuk close event
      function deleteEo(id) {
        console.log('ok');
        const conf = confirm(`Apakah anda yakin untuk menghapus EO ini?`);
        
        if (conf) {
          $.ajax({
            type: "post",
            url: "close.php",
            data: {id},
            success: (data) => {
              const res = $.parseJSON(data);

              if (res.success) {
                alert('Anda berhasil menghapus EO.');
                window.location = '../event-organizer';
              }
              else {
                alert('Anda gagal menghapus EO. Silahkan coba lagi.');
              }
            }
          });
        }
      }
    </script>
  </body>
</html>
