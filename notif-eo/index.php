<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) && $_SESSION['username'] == "eo" ? $_SESSION['id'] : header("location:../login/");
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <link href="<?=BASE_URL.DS.'assets/css/dataTables.bootstrap4.min.css'?>" rel="stylesheet">
    <title>Notif EO</title>
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
              <th>Notifikasi</th>
              <th>Tanggal</th>
              <th></th>
              <th></th>
              <th></th>
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
    
          "ajax": {
    
            "url": "json/data-notif.php",
    
          },
          "order": [[ 1, "desc" ]]
        });
        setInterval(function(){
          table.ajax.reload();
        }, 120000); //reload setiap 2 menit

        table.columns(2).visible(false);
        table.columns(3).visible(false);
        table.columns(4).visible(false);
      })
    </script>
  </body>
</html>
