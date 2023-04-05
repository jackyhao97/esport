<?php 
  session_start();
  require_once '../../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../../login/");

  if (isset($_POST["btn_submit"])) {
    $nama = isset($_POST['txt_nama']) ? mysqli_real_escape_string($conn, $_POST['txt_nama']) : '';
    $jenis_eo = isset($_POST['txt_jenis_eo']) ? $_POST['txt_jenis_eo'] : '';
    $harga_paket_event = isset($_POST['txt_harga_paket_event']) ? $_POST['txt_harga_paket_event'] : '';
    $custom_event = isset($_POST['rdo_custom_event']) ? $_POST['rdo_custom_event'] : '';
    $foto_event = $_FILES['fil_upload_event'];
    $createdon = date('Y-m-d H:i:s');

    if ($nama != "" and $jenis_eo != "" and $harga_paket_event != "" and $custom_event != "") {
      $insert = $conn->query("INSERT INTO tb_event_organizer (nama, jenis, harga_paket_event, is_custom, path, is_active, created_on, created_by) VALUES ('$nama', '$jenis_eo', '$harga_paket_event', '$custom_event', '$foto_event', 1, '$createdon', '$id')");
  
      if ($insert) {
        echo "<script>alert('Event Organizer berhasil ditambah!')</script>";
      }
      else {
        echo "<script>alert('Event Organizer gagal ditambah!')</script>";
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../../header.php';
    ?>
    <title>Posting Event Organizer</title>
  </head>
  <body>
    <?php 
      require_once '../../navbar.php';
    ?>

    <!-- Tampilan Posting Event Organizer -->
    <div class="container">
      <form class="esport-posting-eo m-auto mt-5" method="post">
        <div class="row mb-3">
          <label for="txt_nama" class="col-sm-2 form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_nama" name="txt_nama" autofocus required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="txt_jenis_eo" class="col-sm-2 form-label">Jenis EO</label>
          <div class="col-sm-10">
            <select class="form-select" aria-label="Default select example" id="txt_jenis_eo" name="txt_jenis_eo">
              <?php 
                $sql = $conn->query("SELECT id, deskripsi FROM tb_tipe_event");
                while ($rowTipe = $sql->fetch_array()) :
              ?>
                <option value="<?=$rowTipe['id']?>" selected><?=$rowTipe['deskripsi']?></option>
              <?php
                endwhile;
              ?>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="txt_harga_paket_event" class="col-sm-2 form-label">Harga Paket Event</label>
          <div class="col-sm-10">
            <textarea class="form-control" aria-label="Harga Paket Event" id="txt_harga_paket_event" name="txt_harga_paket_event" required></textarea>
            <textarea class="form-control" aria-label="Harga Paket Event" id="txt_harga_paket_event_2" name="txt_harga_paket_event_2" required></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="txt_custom_event" class="col-sm-2 form-label">Custom Event</label>
          <div class="col-sm-10">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rdo_custom_event" value="option1">
              <label class="form-check-label" for="inlineRadio1">Ya</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rdo_custom_event" value="option2">
              <label class="form-check-label" for="inlineRadio2">Tidak</label>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="txt_foto_event" class="col-sm-2 form-label">Foto Event</label>
          <div class="col-sm-10">
            <input type="file" name="fil_upload_event" id="fil_upload_event" data-filename-placement="inside" onchange="resizeAndRead(this)">
            <div class="col-md-8 col-sm-8 col-xs-8">
              <div class="my-gallery">
                <figure id="fil_upload_event_card">No Image</figure>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <a href="../../" class="btn btn-dark text-right">Cancel</a>
          <div>
            <button type="submit" class="btn btn-dark" name="btn_submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <!-- End -->
    <?php 
      require_once '../../footer.php';
    ?>

    <script>
      const dataURLToBlob = function(dataURL) {
        let BASE64_MARKER = ';base64,';
        if (dataURL.indexOf(BASE64_MARKER) == -1) {
          let parts = dataURL.split(',');
          let contentType = parts[0].split(':')[1];
          let raw = parts[1];

          return new Blob([raw], {type: contentType});
        }

        let parts = dataURL.split(BASE64_MARKER);
        let contentType = parts[0].split(':')[1];
        let raw = window.atob(parts[1]);
        let rawLength = raw.length;

        let uInt8Array = new Uint8Array(rawLength);

        for (let i = 0; i < rawLength; ++i) {
          uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], {type: contentType});
      }
      
      window.imageResize = { blob: null, url: null }
      window.imageResizeEdit = { blob: null, url: null }

      function resizeAndRead(input){
        // Read
        if (input.files && input.files[0]) {
          const element = input.id;
          const reader = new FileReader();

          reader.onload = (e) => {
            $(`#${element}_card`).html(
              `<img class="file-card__image w-100" id="${element}_preview" src="${e.target.result}" />`
            );
          };
          reader.readAsDataURL(input.files[0]);
        }

        // Resize
        var file = event.target.files[0];

        if(file.type.match(/image.*/)) {
          var reader = new FileReader();
          reader.onload = function (readerEvent) {
            var image = new Image();
            image.onload = function (imageEvent) {
              var canvas = document.createElement('canvas'),
                max_size = 1280,// TODO : pull max size from a site config
                width = image.width,
                height = image.height;
              if (width > height) {
                if (width > max_size) {
                  height *= max_size / width;
                  width = max_size;
                }
              } else {
                if (height > max_size) {
                  width *= max_size / height;
                  height = max_size;
                }
              }
              canvas.width = width;
              canvas.height = height;
              canvas.getContext('2d').drawImage(image, 0, 0, width, height);
              var dataUrl = canvas.toDataURL('image/jpeg');
              imageResize.url = dataUrl;
              imageResize.blob = dataURLToBlob(dataUrl);
            }
            image.src = readerEvent.target.result;
          }
          reader.readAsDataURL(file);
        }
        else {
          imageResize.url = 'not-an-image';
          imageResize.blob = 'not-an-image';
          alert('File bukan gambar! Mohon diganti');
        }
      };
    </script>
  </body>
</html>
