<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../login/");
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <link href="<?=BASE_URL.DS.'assets/css/dataTables.bootstrap4.min.css'?>" rel="stylesheet">
    <title>Notifikasi</title>
  </head>
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Notifikasi -->
    <div class="container mt-100">
      
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
    <!-- Datatables plugins -->
    <script src="<?=BASE_URL.DS.'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?=BASE_URL.DS.'assets/js/dataTables.bootstrap4.min.js'?>"></script>
  </body>
</html>
