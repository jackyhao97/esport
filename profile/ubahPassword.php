<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../index.php");
  
  if (isset($_POST['btn_kirim'])) {
    $password = isset($_POST['txt_password']) ? md5($_POST['txt_password']) : '';
    $konfirmasipassword = isset($_POST['txt_konfirmasi_password']) ? md5($_POST['txt_konfirmasi_password']) : '';
    $modifiedon = date('Y-m-d H:i:s');

    if ($_POST['txt_password'] != '') {
      if ($password == $konfirmasipassword) {
        $update = $conn->query("UPDATE tb_account SET password='$password', modified_on='$modifiedon' WHERE id = $id");
    
        if ($update) {
          echo "<script>alert('Password berhasil diubah!');window.location='./';</script>";
        }
        else {
          echo "<script>alert('Password gagal diubah!')</script>";
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
    <title>Ubah Password</title>
  </head>
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Profile User -->
    <div class="container mt-100 p-5" style="background:#eee">
      <div class="row">
        <h3 class="fw-bold">Ubah Password</h3>
      </div>
      <div class="row mt-5">
        <div class="col-12 mt-5 mt-sm-0">
          <form method="post">
            <div class="mb-3">
              <label for="txt_password" class="form-label">Password Baru</label>
              <input type="password" class="form-control" id="txt_password" name="txt_password" autofocus>
            </div>
            <div class="mb-3">
              <label for="txt_konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
              <input type="password" class="form-control" id="txt_konfirmasi_password" name="txt_konfirmasi_password">
            </div>
            <div class="mb-3 d-flex justify-content-between">
              <input type="submit" class="btn btn-dark" name="btn_kirim" value="Kirim" id="btn_kirim">
              <input type="button" class="btn btn-dark" name="btn_batal" id="btn_batal" value="Batal">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>

    <script>
      $("#btn_batal").click(function(){
				window.location='./';
			});
    </script>
  </body>
</html>
