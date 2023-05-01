<?php 
  session_start();
  require_once '../config.php';

  $id = $_GET["id"];
  $user = $_SESSION['id'];
  $result = $conn->query("SELECT pe.id as ideo, nama, jenis_eo, is_custom, path, history, tipe, deskripsi, created_on, created_by FROM `tb_post_eo` pe LEFT JOIN `tb_tipe_event` te ON pe.jenis_eo = te.id WHERE pe.id = '$id'");
  $row = $result->fetch_array();
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
      require_once '../navbar.php';
    ?>

    <div class="container mt-100 p-3" style="background:#eee">
      <div class="row">
        <div class="col-12">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../event-organizer/">Event Organizer</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?=$row['nama']?></li>
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
                $resultharga = $conn->query("SELECT * FROM `tb_harga_paket` WHERE post_eo_id = '$id'");
                $paket = 1;
                while ($rowharga = $resultharga->fetch_array()) :
              ?>
                <div class="col-12 col-md-6">
                  <div class="card border-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                      <div>
                        Paket <?=$paket?>
                      </div>
                      <div>
                        <input class="form-check-input radiopaket" type="radio" name="radioNoLabel" id="radioNoLabel1" value="<?=$rowharga['id']?>" aria-label="...">
                      </div>
                    </div>
                    <div class="card-body">
                      <!-- <h5 class="card-title">Light card title</h5> -->
                      <p class="card-text"><?=$rowharga['deskripsi_harga']?></p>
                    </div>
                  </div>
                </div>
              <?php
                $paket++;
                endwhile;

                if ($row['is_custom'] == 1) :
              ?>
                <div class="col-12 col-md-6">
                  <div class="card border-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                      <div>
                        Custom
                      </div>
                      <div>
                        <input class="form-check-input radiopaket" type="radio" name="radioNoLabel" id="radioNoLabel1" value="0" aria-label="...">
                      </div>
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
              <p><?=$row['nama']?></p>
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
        var hargapaket = $(".radiopaket:checked").val();
        if (hargapaket == undefined) {
          alert('Paket belum dipilih!');
        }
        else {
          const conf = confirm(`Apakah anda yakin untuk register untuk event organizer ini?`);
          if (conf) {
            $.ajax({
              type: "post",
              url: "register.php",
              data: { id, user, hargapaket },
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
    </script>
  </body>
</html>
