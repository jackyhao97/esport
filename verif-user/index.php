<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) && $_SESSION['username'] == "admin" ? $_SESSION['id'] : header("location:../login/");
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <link href="<?=BASE_URL.DS.'assets/css/dataTables.bootstrap4.min.css'?>" rel="stylesheet">
    <title>Verif User</title>
  </head>
  <body>
    <?php 
      require_once '../navbar-white.php';
    ?>

    <!-- Tampilan Verif User -->
    <div class="container mt-100">
      <div class="table-responsive">
        <table class="table cell-border" id="verif-user-all" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>User</th>
              <th>Verified User</th>
              <th>Allow</th>
              <th>Cancel</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- End -->

    <?php 
      require_once '../footer.php';
    ?>
    <!-- Datatables plugins -->
    <script src="<?=BASE_URL.DS.'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?=BASE_URL.DS.'assets/js/dataTables.bootstrap4.min.js'?>"></script>

    <script>
      $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
    
        const table = $('#verif-user-all').on('error.dt', function(e, settings, techNote, message) {
    
          if (techNote == 1)
    
          {
    
            alert('Your session timed out due to inactivity, you will logged off automatically. Please, click OK and sign in again.');
    
          } else
    
          {
    
            alert(message);
    
          }
    
        }).DataTable({
    
          "processing": true,
    
          "serverSide": true,
    
          "deferRender": true,
    
          "stateSave": true,
    
          "stateDuration": -1,
    
          "pageLength": 25,

          "ordering": false,
    
          "ajax": {
    
            "url": "json/data-verif.php",
    
          }
        });
        setInterval(function(){
          table.ajax.reload();
        }, 120000); //reload setiap 2 menit
      })

      // untuk tombol verifikasi user
      function initUserVerif(id) {
        const conf = confirm(`Yakin untuk verif user ini?`);
        if (conf) {
          $.ajax({
            type: "post",
            url: "verifUser.php",
            data: { id },
            success: (data) => {
              const res = $.parseJSON(data);

              if (res.success) {
                alert('User berhasil diverif.');
                $("#verif-user-all").DataTable().ajax.reload();
              }
              else {
                alert('User gagal diverif.');
                $("#verif-user-all").DataTable().ajax.reload();
              }
            }
          });
        }
      }

      function initCancelVerif(id) {
        const conf = confirm(`Yakin untuk cancel user ini?`);
        if (conf) {
          $.ajax({
            type: "post",
            url: "cancelUser.php",
            data: { id },
            success: (data) => {
              const res = $.parseJSON(data);

              if (res.success) {
                alert('User berhasil dihapus.');
                $("#verif-user-all").DataTable().ajax.reload();
              }
              else {
                alert('User gagal dihapus.');
                $("#verif-user-all").DataTable().ajax.reload();
              }
            }
          });
        }
      }
    </script>
  </body>
</html>
