<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../index.php");
  
  // Fetch data account
  $fetch = $conn->query("SELECT * FROM tb_account WHERE id = $id");
  $row = $fetch->fetch_array();
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Profile Ligasport</title>
  </head>
  <body>
    <?php 
      require_once '../navbar-white.php';
    ?>

    <!-- Tampilan Profile User -->
    <div class="container mt-100">
      <div class="row">
        <h3 class="fw-bold">Profile</h3>
      </div>
      <div class="row mt-5">
        <div class="col-12 col-md-6 col-lg-6 text-center d-flex justify-content-between flex-column">
          <div>
            <?php 
              if ($row['path'] == '') :
            ?>
            <img src="<?=BASE_URL.DS.'assets/img/user.png'?>" alt="User" class="img-user">
            <?php 
              else :
            ?>
            <img src="<?=BASE_URL.DS.'assets/img/profile/'.$row['path']?>" alt="User" class="img-user">
            <?php 
              endif;
            ?>
          </div>
          <!-- <button type="submit" class="btn btn-dark" name="btn_profile">Edit Profile</button> -->
          <a href="editProfile.php?id=<?=$row['id']?>" class="btn btn-dark">Edit Profile</a>
        </div>
        <div class="col-12 col-md-6 col-lg-6 mt-5 mt-sm-0">
          <div class="mb-3">
            <label for="txt_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="txt_username" name="txt_username" value="<?=$row['username']?>" readonly>
          </div>
          <div class="mb-3">
            <label for="txt_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="txt_nama" name="txt_nama" value="<?=$row['nama']?>" autofocus readonly>
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
