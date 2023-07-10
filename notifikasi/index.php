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
      require_once '../navbar-white.php';
    ?>

    <!-- Tampilan Notifikasi -->
    <div class="container mt-100">
      <div class="table-responsive">
        <table class="table cell-border" id="notif-all" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Notifikasi</th>
              <th>Tipe</th>
              <th>Nama</th>
              <th>Verified Event</th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- End -->

    <!-- Tampilam Modal Detail -->
    <!-- Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDetailLabel">Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row align-items-center">
              <label for="txt_nama" class="form-label col-sm-3 text-center">Nama</label>
              <div class="col-sm-8">
                <p id="txt_nama" name="txt_nama"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_tipe" class="form-label col-sm-3 text-center">Tipe</label>
              <div class="col-sm-8">
                <p id="txt_tipe" name="txt_tipe"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_jenis" class="form-label col-sm-3 text-center">Jenis</label>
              <div class="col-sm-8">
                <p id="txt_jenis" name="txt_jenis"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_prize_pool" class="form-label col-sm-3 text-center">Prize Pool</label>
              <div class="col-sm-8">
                <p id="txt_prize_pool" name="txt_prize_pool"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_max_slot" class="form-label col-sm-3 text-center">Max Slot</label>
              <div class="col-sm-8">
                <p id="txt_max_slot" name="txt_max_slot"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_genre_game" class="form-label col-sm-3 text-center">Genre Game</label>
              <div class="col-sm-8">
                <p id="txt_genre_game" name="txt_genre_game"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_lokasi" class="form-label col-sm-3 text-center">Lokasi</label>
              <div class="col-sm-8">
                <p id="txt_lokasi" name="txt_lokasi"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_no_hp" class="form-label col-sm-3 text-center">Tgl Awal Event</label>
              <div class="col-sm-8">
                <p id="txt_tgl_awal_event" name="txt_tgl_awal_event"></p>
              </div>
              <hr>
            </div>
            <div class="row align-items-center">
              <label for="txt_no_hp" class="form-label col-sm-3 text-center">Tgl Akhir Event</label>
              <div class="col-sm-8">
                <p id="txt_tgl_akhir_event" name="txt_tgl_akhir_event"></p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
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
    
        const table = $('#notif-all').on('error.dt', function(e, settings, techNote, message) {
    
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
    
            "url": "json/data-notif.php",
    
          }
        });
        setInterval(function(){
          table.ajax.reload();
        }, 120000); //reload setiap 2 menit

        table.columns(1).visible(false);
        table.columns(2).visible(false);
        table.columns(5).visible(false);
        table.columns(6).visible(false);
        table.columns(7).visible(false);
        table.columns(8).visible(false);
        table.columns(9).visible(false);
        
        
        if (<?=$id?> == 14) table.columns(4).visible(true)
        else table.columns(4).visible(false)
      })


      // untuk tombol verifikasi event
      function initVerif(id) {
        const conf = confirm(`Yakin untuk verif event ini?`);
        if (conf) {
          $.ajax({
            type: "post",
            url: "verifEvent.php",
            data: { id },
            success: (data) => {
              const res = $.parseJSON(data);

              if (res.success) {
                alert('Event berhasil diverif.');
                $("#notif-all").DataTable().ajax.reload();
              }
              else {
                alert('Event gagal diverif.');
                $("#notif-all").DataTable().ajax.reload();
              }
            }
          });
        }
      }

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
                $("#notif-all").DataTable().ajax.reload();
              }
              else {
                alert('User gagal diverif.');
                $("#notif-all").DataTable().ajax.reload();
              }
            }
          });
        }
      }

      function reformatDate(dateStr)
      {
        var dArr = dateStr.split("-");  // ex input: "2010-01-18"
        return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0]; //ex output: "18/01/10"
      }

      // Untuk tampilkan data
      function show(id) {
        $.ajax({
          type: "post",
          data: {id},
          url: "showDetail.php",
          success: (data) => {
            let res = JSON.parse(data);
            if (res.success == 1) {
              $("#hid_id").val(res.data[0].hid_id);
              $("#txt_nama").html(res.data[0].nama);
              $("#txt_tipe").html(res.data[0].tipe);
              $("#txt_jenis").html(res.data[0].jenis);
              $("#txt_prize_pool").html(res.data[0].prize_pool);
              $("#txt_max_slot").html(res.data[0].max_slot);
              $("#txt_genre_game").html(res.data[0].genre_game);
              $("#txt_lokasi").html(res.data[0].lokasi);
              $("#txt_tgl_awal_event").html(reformatDate(res.data[0].tgl_event_awal));
              $("#txt_tgl_akhir_event").html(reformatDate(res.data[0].tgl_event_akhir));
            }
            else {
              alert("Tampil data error! Please Contact Administrator!");
            }
          },
          error: (err) => {
            alert("Terjadi kesalahan saat menampilkan data.");
            console.log(err);
          },
        });
      }
    </script>
  </body>
</html>
