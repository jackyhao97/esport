<?php 
  session_start();
  require_once '../config.php';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../login/");

  if (isset($_POST["btn_submit"])) {
    $genreMoba = isset($_POST['genre-moba']) ? 1 : 0;
    $genreFps = isset($_POST['genre-fps']) ? 1 : 0;
    $genreBattleRoyale = isset($_POST['genre-battle-royale']) ? 1 : 0;
    $genreFighting = isset($_POST['genre-fighting']) ? 1 : 0;
    $genreTalkshow = isset($_POST['genre-talkshow']) ? 1 : 0;
    $genre_game = $genreMoba . "," . $genreFps . "," . $genreBattleRoyale . "," . $genreFighting . "," . $genreTalkshow;

    $nama = isset($_POST['txt_nama']) ? mysqli_real_escape_string($conn, $_POST['txt_nama']) : '';
    $tipe_event = isset($_POST['txt_tipe_event']) ? $_POST['txt_tipe_event'] : '';
    $jenis_event = isset($_POST['txt_jenis_event']) ? $_POST['txt_jenis_event'] : '';
    $prize_pool = isset($_POST['txt_prize_pool']) ? $_POST['txt_prize_pool'] : '';
    $max_slot = isset($_POST['txt_max_slot']) ? $_POST['txt_max_slot'] : '';
    // $genre_game = isset($_POST['txt_genre_game']) ? $_POST['txt_genre_game'] : '';
    $lokasi = isset($_POST['txt_lokasi']) ? mysqli_real_escape_string($conn, $_POST['txt_lokasi']) : '';
    $createdon = date('Y-m-d H:i:s');
    $file = $_FILES['fil_upload_event'];

    if ($nama != "" and $prize_pool != "" and $max_slot != "" and $lokasi != "") {
      $new_filename = "EVENT_".rand(1,1000)."_".time().".jpg";
      $upload = move_uploaded_file($file['tmp_name'], "../assets/img/event/".$new_filename);
      $insert = $conn->query("INSERT INTO tb_event (nama, tipe, jenis, prize_pool, max_slot, genre, lokasi, is_active, created_on, created_by, path) VALUES ('$nama', '$tipe_event', '$jenis_event', '$prize_pool', '$max_slot', '$genre_game', '$lokasi', 1, '$createdon', '$id', '$new_filename')");
  
      if ($insert && $upload) {
        echo "<script>alert('Event berhasil ditambah!')</script>";
      }
      else if (!$insert && $upload) {
        echo "<script>alert('Foto Event berhasil diupload namun gagal disimpan ke database')</script>";
      }
      else {
        echo "<script>alert('Event gagal ditambah!')</script>";
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Create Event</title>
  </head>
  <body>
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Login -->
    <div class="container d-flex">
      <form class="esport-create-event m-auto mt-5" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="txt_nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="txt_nama" name="txt_nama" autofocus required>
        </div>
        <div class="mb-3">
          <label for="txt_tipe_event" class="form-label">Tipe Event</label>
          <select class="form-select" aria-label="Default select example" id="txt_tipe_event" name="txt_tipe_event">
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
        <div class="mb-3">
          <label for="txt_jenis_event" class="form-label">Jenis Event</label>
          <select class="form-select" aria-label="Default select example" id="txt_jenis_event" name="txt_jenis_event">
          <?php 
              $sql = $conn->query("SELECT id, jenis FROM tb_jenis_event");
              while ($rowJenis = $sql->fetch_array()) :
            ?>
              <option value="<?=$rowJenis['id']?>" selected><?=$rowJenis['jenis']?></option>
            <?php
              endwhile;
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="txt_prize_pool" class="form-label">Prize Pool</label>
          <input type="text" class="form-control" id="txt_prize_pool" name="txt_prize_pool" required>
        </div>
        <div class="mb-3">
          <label for="txt_max_slot" class="form-label">Max Slot</label>
          <input type="text" class="form-control" id="txt_max_slot" name="txt_max_slot" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Genre Game</label>
          <?php 
              $sql = $conn->query("SELECT * FROM tb_genre where is_active = 1");
              while ($rowGenre = $sql->fetch_array()) :
            ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="chk-<?=$rowGenre['genre']?>" name="genre-<?=$rowGenre['genre']?>">
              <label class="form-check-label" for="chk-<?=$rowGenre['genre']?>">
                <?=$rowGenre['deskripsi']?>
              </label>
            </div>
          <?php
            endwhile;
          ?>

          <!-- <select class="form-select" aria-label="Default select example" id="txt_genre_game" name="txt_genre_game">
          <?php 
              $sql = $conn->query("SELECT id, deskripsi FROM tb_genre");
              while ($rowGenre = $sql->fetch_array()) :
            ?>
            <option value="<?=$rowGenre['id']?>" selected><?=$rowGenre['deskripsi']?></option>
          <?php
            endwhile;
          ?>
          </select> -->
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="txt_foto_event" class="col-sm-2 form-label">Foto Event</label>
            <div class="col-sm-10">
              <input type="file" name="fil_upload_event" id="fil_upload_event" data-filename-placement="inside" onchange="resizeAndRead(this)">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="my-gallery">
                  <figure id="fil_upload_event_card">No Image</figure>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="txt_lokasi" class="form-label">Lokasi</label>
          <textarea class="form-control" aria-label="Lokasi" id="txt_lokasi" name="txt_lokasi" required></textarea>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <a href="../" class="btn btn-dark text-right">Cancel</a>
          <div>
            <button type="submit" class="btn btn-dark" name="btn_submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
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
