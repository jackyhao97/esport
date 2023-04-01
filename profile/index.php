<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../index.php");
  
  $fetch = $conn->query("SELECT * FROM tb_account WHERE id = $id");
  $row = $fetch->fetch_array();
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Profile</title>
  </head>
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Profile User -->
    <div class="container">
      <div class="row">
        <h3 class="mt-5">Profile</h3>
      </div>
      <div class="row mt-5">
        <div class="col-12 col-md-6 col-lg-6 text-center d-flex justify-content-between flex-column">
          <div>
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" alt="User" class="img-user">
          </div>
          <button type="submit" class="btn btn-dark" name="btn_profile">Edit Profile</button>
        </div>
        <div class="col-12 col-md-6 col-lg-6 mt-5 mt-sm-0">
          <div class="mb-3">
            <label for="txt_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="txt_nama" name="txt_nama" value="<?=$row['nama']?>" autofocus readonly>
          </div>
          <div class="mb-3">
            <label for="txt_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="txt_username" name="txt_username" value="<?=$row['username']?>" readonly>
          </div>
          <div class="mb-3">
            <label for="txt_email" class="form-label">Email Address</label>
            <input type="text" class="form-control" id="txt_email" name="txt_email" value="<?=$row['email']?>" readonly>
          </div>
          <div class="mb-3">
            <label for="txt_nomor" class="form-label">Nomor</label>
            <input type="text" class="form-control" id="txt_nomor" name="txt_nomor" value="<?=$row['nomor']?>" readonly>
          </div>
        </div>
      </div>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
