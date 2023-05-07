<?php 
  require_once '../config.php';
  if (isset($_POST['btn_submit'])) {
    $genreMoba = isset($_POST['genreMoba']) ? 1 : 0;
    $genreFps = isset($_POST['genreFps']) ? 1 : 0;
    $genreBattleRoyale = isset($_POST['genreBattleRoyale']) ? 1 : 0;
    $genreFighting = isset($_POST['genreFighting']) ? 1 : 0;
    $genreTalkshow = isset($_POST['genreTalkshow']) ? 1 : 0;
    $genreAll = isset($_POST['genreAll']) ? 1 : 0;
    $genre = $genreMoba . "," . $genreFps . "," . $genreBattleRoyale . "," . $genreFighting . "," . $genreTalkshow;
    $genres = $genreAll == 1 ? '1,1,1,1,1' : $genre; 

    $nama = isset($_POST['txt_nama']) ? $_POST['txt_nama'] : '';
    $username = isset($_POST['txt_username']) ? $_POST['txt_username'] : '';
    $password = isset($_POST['txt_password']) ? md5($_POST['txt_password']) : '';
    $konfirmasipassword = isset($_POST['txt_konfirmasi_password']) ? md5($_POST['txt_konfirmasi_password']) : '';
    $emailaddress = isset($_POST['txt_email_address']) ? $_POST['txt_email_address'] : '';
    $tipe = isset($_POST['txt_tipe']) ? $_POST['txt_tipe'] : '';
    $nomor = isset($_POST['txt_nomor']) ? $_POST['txt_nomor'] : '';
    $createdon = date('Y-m-d H:i:s');

    if ($_POST['txt_password'] != '') {
      if ($password == $konfirmasipassword) {
        $insert = $conn->query("INSERT INTO tb_account (nama, username, password, email, tipe, nomor, is_active, created_on, genre) VALUES ('$nama', '$username', '$password', '$emailaddress', '$tipe', '$nomor', 1, '$createdon', '$genres')");
    
        if ($insert) {
          echo "<script>alert('Register berhasil!')</script>";
        }
        else {
          echo "<script>alert('Register gagal!')</script>";
        }
      }
      else {
        echo "<script>alert('Password tidak match!')</script>";
      }
    }
    else {
      echo "<script>alert('Password belum diisi!')</script>";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Register Esports</title>
  </head>
  <body style="background: url('../assets/img/bg-login.jpg')">
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Login -->
    <div class="container d-flex mt-100">
      <form class="esport-login m-auto bg-login" method="post">
        <img src="../assets/img/logo.png" alt="Ligasport" class="w-50 text-center mb-3 d-flex m-auto">
        <div class="mb-3">
          <label for="txt_nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="txt_nama" name="txt_nama" autofocus>
        </div>
        <div class="mb-3">
          <label for="txt_username" class="form-label">Username</label>
          <input type="text" class="form-control" id="txt_username" name="txt_username">
        </div>
        <div class="mb-3">
          <label for="txt_email_address" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="txt_email_address" name="txt_email_address">
        </div>
        <div class="mb-3">
          <label for="txt_password" class="form-label">Password</label>
          <input type="password" class="form-control" id="txt_password" name="txt_password">
        </div>
        <div class="mb-3">
          <label for="txt_konfirmasi_password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="txt_konfirmasi_password" name="txt_konfirmasi_password">
        </div>
        <div class="mb-3">
          <label for="txt_tipe" class="form-label">Tipe</label>
          <select class="form-select" aria-label="Default select example" id="txt_tipe" name="txt_tipe">
            <?php 
              $sql = $conn->query("SELECT id, tipe, deskripsi FROM tb_tipe_user WHERE tipe != 'admin' ORDER BY id DESC");
              while ($row = $sql->fetch_array()) :
            ?>
              <option value="<?=$row['id']?>" selected><?=$row['deskripsi']?></option>
            <?php
              endwhile;
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="txt_nomor" class="form-label">Nomor</label>
          <input type="text" class="form-control" id="txt_nomor" name="txt_nomor">
        </div>
      <div class="mb-5">
        <label class="form-label">Apa genre game yang kamu sukai</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="chkMoba" name="genreMoba">
          <label class="form-check-label" for="chkMoba">
            Moba
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="2" id="chkFps" name="genreFps">
          <label class="form-check-label" for="chkFps">
            FPS
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="3" id="chkBattleRoyale" name="genreBattleRoyale">
          <label class="form-check-label" for="chkBattleRoyale">
            Battle Royale
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="4" id="chkFighting" name="genreFighting">
          <label class="form-check-label" for="chkFighting">
            Fighting
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="5" id="chkTalkshow" name="genreTalkshow">
          <label class="form-check-label" for="chkTalkshow">
            Talkshow
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="6" id="chkAll" name="genreAll">
          <label class="form-check-label" for="chkAll">
            Semua genre diatas
          </label>
        </div>
      </div>
        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn btn-primary" name="btn_submit">Register</button>
          <div>
            <span>Sudah punya account?</span>
            <a href="../login/" class="text-right">Login</a>
          </div>
        </div>
      </form>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
