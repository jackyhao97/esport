<?php 
  require_once '../config.php';
  if (isset($_POST['btn_submit'])) {
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
        $insert = $conn->query("INSERT INTO tb_account (nama, username, password, email, tipe, nomor, is_active, created_on) VALUES ('$nama', '$username', '$password', '$emailaddress', '$tipe', '$nomor', 1, '$createdon')");
    
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
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Login -->
    <div class="container d-flex">
      <form class="esport-login m-auto mt-5" method="post">
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
        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn btn-primary" name="btn_submit">Register</button>
          <a href="../login/" class="text-right">Login</a>
        </div>
      </form>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
